<?php

namespace App\Http\Controllers\API\User;

use stdClass;
use App\Models\User\User;
use App\Models\User\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Repositories\User\UserRepositoryInterface;

class ProfileController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function index($author, $deptauthor , $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
    {
        if (auth('api')->user()) {
            $profiles = Profile::with('user')->paginate(7);
            return response()->json([
                'profiles' => $profiles,
            ], 200);
        }
    }
    public function authuser($author, $deptauthor , $authid, $authinstitution, $authinstitutionid, $authdepartmentid)
    {
        if (auth('api')->user()) {
            $profile = Profile::where('user_id', auth('api')->user()->id)->first();
            return response()->json([
                'profile' => $profile,
            ], 200);
        }
    }

    public function filter(Request $request)
    {
        // $existance_status = null;
        $phone = str_replace(' ', '', $request->phone);
        // dd($phone, $request->phone);
        // $profile = true;
        // $prof = Profile::where('phone', $phone)->first();
        // $users = User::role('Client')->get();
        // $users = User::with("roles")->whereHas("roles", function($q) {
        //     $q->where("name", 'Client');
        // })->get();
        $prof = Profile::where('phone', $phone)
                ->with('user')
                ->whereIn('user_id', User::role('Client')->pluck('id'))->first();

                // dd($phone, $request->phone, $prof->user_id, User::role('Client')->pluck('id'));
            if ($prof){
                $profile = $prof;
                $existance_status = true;
                $code = 200;
            }else{
                $profile = new stdClass;
                $profile->phone = $phone;

                $existance_status = false;
                $code = 200;
            }

        return response()->json([
            'existance_status' => $existance_status,
            'profile'          => $profile,
        ], $code);

    }

    public function RegisterUser(Request $request) {
        $user = $this->userRepository->registerUser($request);
        return $user;
    }

    public function validation(Request $request)
    {
        return $this->validate($request,[
                'phone'            =>'required',
                'residence'        =>'required',
                'address'          =>'required',
                'gender_id'        =>'required',
                'country_id'       =>'required',
                'county_id'        =>'required',
//photo
//active
//phone
//residence
//address
//user_id
//gender_id
//country_id
//county_id
//constituency_id
//ward_id
            ]);
    }
    public function store(Request $request)
    {
        if (auth('api')->user()) {
            $this->validate($request,[
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'roles'             => 'required',
                'permissions'       => 'required',

                'user_id'           => 'required',
                'gender_id'         => 'required',
                // 'patient_id'        => 'required',
                'photo'             => 'required',
                'active'            => 'required',
                'phone'             => 'required',
                'address'           => 'required',
                'postalcode_id'     => 'required',
                'country_id'        => 'required',
                'county_id'         => 'required',
                'constituency_id'   => 'required',
                'ward_id'           => 'required',
            ]);

            $user = $this->RegisterUser($request);
                //dd($user);
            if($user){
                     $phone = str_replace(' ', '', $request->phone);

                     $profile = new Profile();
                     $profile->user_id         = $request->user_id;
                     $profile->gender_id       = $request->gender_id;
                     $profile->patient_id      = $request->patient_id;
                     if($profile){
                         $profile = new Profile();
                         $profile->user_id         = $profile->user_id;
                         $profile->gender_id       = $request->gender_id;
                         $profile->patient_id      = $profile->id;
                         if($request->photo){
                             $strpos = strpos($request->photo, ';');
                             $sub = substr($request->photo, 0, $strpos);
                             $ex = explode('/', $sub)[1];
                             $name = time() . "." . $ex;
                             $Path = public_path() . "/assets/img";
                             $img = Image::make($request->photo);
                             $img->save($Path . '/' . $name);
                         }else{
                             $name = null;
                         }
                     $profile->photo           = $name;
                     $profile->active          = true;
                     $profile->phone           = $phone;
                     $profile->address         = $request->address;
                     $profile->postalcode_id   = $request->postalcode_id;
                     $profile->country_id      = $request->country_id;
                     $profile->county_id       = $request->county_id;
                     $profile->constituency_id = $request->constituency_id;
                     $profile->ward_id         = $request->ward_id;
                     $profile->save();
                     $profile->load('user');
                 }
             }

                return response()->json([
                    'profile' => $profile,
                ], 200);
         }
    }

    public function update(Request $request, $id)
    {
        if (auth('api')->user()) {
            $this->validate($request,[
                'user_id'           => 'required',
                'gender_id'         => 'required',
                'photo'             => 'required',
                'active'            => 'required',
                'phone'             => 'required|phone|unique:profiles',
                'address'           => 'required',
                'postalcode_id'     => 'required',
                'country_id'        => 'required',
                'county_id'         => 'required',
                'constituency_id'   => 'required',
                'ward_id'           => 'required',
            ]);

            $profile = Profile::find($id);
                $phone = str_replace(' ', '', $request->phone);


                $profile->user_id         = $request->user_id;
                $profile->gender_id       = $request->gender_id;
                $profile->patient_id      = $request->patient_id;
                $currentPhoto =  $profile->photo;
                if ($request->photo != $currentPhoto) {
                    $Path = public_path() . "/assets/img/";
                    $S_currentPhoto = $Path . $currentPhoto;
                    if (file_exists($S_currentPhoto)) {
                        @unlink($S_currentPhoto);
                    }
                    $strpos = strpos($request->photo, ';');
                    $sub = substr($request->photo, 0, $strpos);
                    $ex = explode('/', $sub)[1];
                    $name = time() . "." . $ex;
                    $img = Image::make($request->photo);
                    $img->save($Path . '/' . $name);
                } else {
                    $name = $profile->photo;
                }
                $profile->photo           = $name;
                $profile->active          = true;
                $profile->phone           = $phone;
                $profile->address         = $request->address;
                $profile->postalcode_id   = $request->postalcode_id;
                $profile->country_id      = $request->country_id;
                $profile->county_id       = $request->county_id;
                $profile->constituency_id = $request->constituency_id;
                $profile->ward_id         = $request->ward_id;
                $profile->save();
                $profile->load('user');

            return response()->json([
                'profile' => $profile,
            ], 200);
        }
    }

    public function destroy($id)
    {
        if(auth('api')->user()){
            $profile = Profile::findOrFail($id);
            $profile->delete();
            $profile->load('user');
            return response()->json([
                'profile' => $profile,
            ], 200);
        }
    }
}
