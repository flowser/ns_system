<?php

namespace App\Http\Controllers\Notification;

use stdClass;
use App\Rules\PhoneRule;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Models\Channel\Message;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Events\SendMessageNotification;
use App\Models\Channel\MessageAnalytic;
use App\Events\SendMidnightNotification;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->guard('api')->user();
        $messages = Message::with($this->relation())->where('sender_id', $user->id)->get();
        return response()->json([
            'messages' => $messages
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createstore(Request $request)
    {
        {
            $this->validate($request,[
                'recipient_id'      => 'required',
                'message'           => 'required',
            ]);

            // dd($request);
            $user = $user = auth()->guard('api')->user();
            // $adminuser = User::role(['Superadmin'])->first();
            $message              =  new Message();
            $message->message     = $request->message;
            // $message->send_method = $request->send_method;
            $message->sender_id   = $user->id;
            $message->recipient_id= $request->recipient_id;
            $message->save();
            $message->load($this->relation());

            $data           = new stdClass;
            $data->user     = $user;
            $data->email    = $user->email;
            $data->message  = $message->message;


            event(new SendMessageNotification($message));

            $messageanalytic                     = New MessageAnalytic();
            $messageanalytic->message_id         = $message->id;
            $messageanalytic->recipient_id       = $message->recipient_id;
            $messageanalytic->delivery_status    = true;
            $messageanalytic->save();

            return response()->json([
                'message' => $message
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addnewmessage(Request $request, $id)
    {
        $this->validate($request,[
            'id'                => 'required',
            'recipient_id'      => 'required',
            'message'           => 'required',
        ]);

        // dd($request);
        $user = User::find($request->sender_id);
        // $adminuser = User::role(['Superadmin'])->first();
        $message              =  new Message();
        $message->message     = $request->message;
        // $message->send_method = $request->send_method;
        $message->sender_id   = $user->id;
        $message->recipient_id= $request->recipient_id;
        $message->save();
        $message->load($this->relation());

        $data           = new stdClass;
        $data->user     = $user;
        $data->email    = $user->email;
        $data->message  = $message->message;
        event(new SendMessageNotification($message));

        $messageanalytic                     = New MessageAnalytic();
        $messageanalytic->message_id         = $message->id;
        $messageanalytic->recipient_id       = $message->recipient_id;
        $messageanalytic->delivery_status    = true;
        $messageanalytic->save();

        return response()->json([
            'message' => $message
        ], 200);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required',
            'phone'             => ['required', new PhoneRule, 'unique:users'],
            'message'           => 'required',
            'roles'             => 'required',
            'permissions'       => 'required',
        ]);

        // dd($request);
        $existinguser = User:: where('email', $request->email)->first();

        if(!$existinguser){
            $password = "123456";
            $input = $request->all();
            $input['password'] = bcrypt($password);
            $user = User::create($input);
            if($request->filled('roles')){
                $user->assignRole($request->roles);
            }
            if($request->filled('permissions')){
                $user->givePermissionTo($request->permissions);
            }
        }else{
            $user = $existinguser;
        }
        $adminuser = User::role(['Superadmin'])->first();

        $message              =  new Message();
        $message->message     = $request->message;
        // $message->send_method = $request->send_method;
        $message->sender_id   = $user->id;
        $message->recipient_id= $adminuser->id;
        $message->save();

        $data           = new stdClass;
        $data->user     = $user;
        $data->email    = $user->email;
        $data->message  = $message->message;
        event(new SendMessageNotification($message));

        $messageanalytic                     = New MessageAnalytic();
        $messageanalytic->message_id         = $message->id;
        $messageanalytic->recipient_id       = $message->recipient_id;
        $messageanalytic->delivery_status    = true;
        $messageanalytic->save();

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function relation(){
        return [
            'sender',
            'recipient',
            // 'profile'
        ];
    }
}
