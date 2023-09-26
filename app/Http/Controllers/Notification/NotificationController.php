<?php

namespace App\Http\Controllers\Notification;

use stdClass;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SendNotificationEvent;

class NotificationController extends Controller
{
    public function index()
        {
            $notifications = auth()->guard('api')->user()->unreadNotifications;
            return response()->json([
                'notifications' => $notifications
            ], 200);
        }
    public function MarkRead(Request $request, $id)
        {
                $notifications = auth()->guard('api')->user()->unreadNotifications;
                $notifications->when($request->input('id'), function ($query) use ($request) {
                    return $query->where('id', $request->input('id'));
                })
                ->markAsRead();
            return $this->index();
        }

        /**
         * Show the form for creating a new resource.
         */
        public function createstore(Request $request)
        {
            {
                $this->validate($request,[
                    'recipient_id'      => 'required',
                    'notification'      => 'required',
                ]);

                // dd($request);
                $recipient = User::find($request->recipient_id);
                $user = $user = auth()->guard('api')->user();
                $data                = new stdClass;
                $data->user          = $user;
                $data->recipient     = $recipient;
                $data->email         = $user->email;
                $data->notification  = $request->notification;

                event(new SendNotificationEvent($data));

                return $this->index();
            }
        }

}
