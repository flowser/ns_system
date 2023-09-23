<?php

namespace App\Http\Controllers\API\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;


class UserController extends Controller
{
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function users($role)
    {    if (auth('api')->user()) {
            $users = User::with('roles', 'permissions')
                ->role($role)->get();
                return response()->json([
                    'users' => $users,
                ], 200);
        }
    }

    public function RegisterUser(Request $request) {
        if (auth('api')->user()) {
            $user = $this->userRepository->registerUser($request);
            return $user;
        }
    }

    public function UpdateUser(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id) {
        if (auth('api')->user()) {
            return response()->json([
                'user' => $this->userRepository->updateUser($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id),
            ], 200);
        }
    }
    public function UserActivation(Request $request, $id) {
        if (auth('api')->user()) {
            $user = $this->userRepository->useractivation($request, $id);
            return $user;
        }
    }



    public function uservalidation (Request $request)
    {
        return $this->existancecheck($request);
    }

    public function existancecheck(Request $request)
    {
        if($request->existance_status == true){
            return $this->validateexistinguser($request);
        }else{
            return $this->validatnewuser($request);
        }
    }

    public function validateexistinguser (Request $request)
    {
        return $this->validate($request,[
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required',
                'password'          => 'required',
        ]);
    }

    public function validatnewuser (Request $request)
    {
        return $this->validate($request,[
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required',
                'password'          => 'required',
                'roles'             => 'required',
                'permissions'       => 'required',
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
            ]);

            $user = $this->RegisterUser($request);
            $user->load('roles', 'permissions');

            return response()->json([
                'user' => $user,
                'status'  => 'The User has been Created',
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth('api')->user()) {
            $this->validate($request,[
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required',
                // 'password'          => 'required',
                'roles'             => 'required',
                'permissions'       => 'required',
            ]);
            // dd($request);
            $user = $this->UpdateUser($request, $id);
            $roles       = $request->roles;
            $permissions = $request->permissions;
            $user->syncRoles($roles);
            $user->syncPermissions($permissions);
            $user->load('roles', 'permissions');

            return response()->json([
                'user' => $user,
                'status'  => 'The User has been Updated',
            ], 200);
        }
    }
    public function activate(Request $request, $id)
    {
        if (auth('api')->user()) {
            $user = $this->UserActivation($request, $id);
            $user->load('roles', 'permissions');
            return response()->json([
                'user' => $user,
                'status'  => 'The User has been Activated',
            ], 200);
        }
    }
    public function deactivate(Request $request, $id)
    {
        if (auth('api')->user()) {
            $failsafeuser = User::findOrFail($id);
            if($failsafeuser->hasRole(['Superadmin', 'Owner'])){
                $user = $failsafeuser->load('roles', 'permissions');
                $status = "You Cannot Deactivate Users that are Either Superadmins or Owners";
                return response()->json([
                    'status' => $status,
                    'user'   => $user,
                ], 422);
            }else{
                $user = $this->UserActivation($request, $id);
                $user->load('roles', 'permissions');
                return response()->json([
                    'user' => $user,
                    'status'  => 'The User has been Deactivated',
                ], 200);
            }
        }
    }

    public function destroy($id)
    {
        if(auth('api')->user()){
            $user = User::findOrFail($id);
            if($user->hasRole(['Superadmin', 'Owner'])){
                $errors = "You Cannot Delete Users that are Either Superadmin or Owner, they are essential for the system to be fully Functional";
                return response()->json([
                    'errors' => $errors,
                ], 422);
            }else{
                $user->delete();
                $user->load('roles', 'permissions');
                return response()->json([
                    'user' => $user,
                ], 200);
            }
        }
    }
}
