<?php

namespace App\Repositories\User;


use stdClass;
use GuzzleHttp\Client;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient;
use App\Models\Business\Businesssetting;
use GuzzleHttp\Exception\ClientException;
use App\Repositories\User\UserRepositoryInterface;
// use App\Repositories\Profile\ProfileRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    const SUCCUSUS_STATUS_CODE = 200;
    const UNAUTHORISED_STATUS_CODE = 401;

    public function __construct(Client $client)
    {
        $this->http = $client;
        // $this->profileRepository = $profileRepository;
    }

    public function register(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        // $profile = $this->profileRepository->registerProfile($request, $user);
        $url = request()->getSchemeAndHttpHost() . "/oauth/token";
        $response = $this->getTokenAndRefreshToken($email, $password, $url);
        return $this->response($response["data"], $response["statusCode"]);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $url = request()->getSchemeAndHttpHost() . "/oauth/token";
        return $this->getTokenAndRefreshToken($email, $password, $url);
    }
    public function createUser(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid) {

        // dd($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid);
        $user = new User();
        $user->email             = $request->email;
        $user->active            = true;
        $user->confirmed         = true;
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->first_name        = $request->first_name;
        $user->last_name         = $request->last_name;
            // password
            if($request->filled('password')){
                $user->password   = Hash::make($request->password);
            }else{
                $user->password   = Hash::make('123456');
            }
        $user->save();

        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }
        // $profile = $this->profileRepository->registerProfile($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $user);
        return $user;
    }

    public function updateUser(Request $request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $id) {

        $user = User::with($this->relation())->find($id);

        $user->first_name       = $request->first_name;
        $user->last_name        = $request->last_name;
        $user->email            = $request->email;
        if($request->filled('password')){
            $user->password         = Hash::make($request->password);
        }
        if($request->filled('roles')){
            $user->assignRole($request->roles);
        }
        if($request->filled('permissions')){
            $user->givePermissionTo($request->permissions);
        }
        $user->active           = true;
        $user->save();
        // $profile = $this->profileRepository->updateProfile($request, $author, $authrole, $authid, $authinstitution, $authinstitutionid, $authroleid, $user);
        return $user;
    }
    public function useractivation (Request $request, $id) {

        $user = User::find($id);
        $user->active     = $request->active;
        $user->save();
        return $user;
    }

    public function ProfileUserMail(Request $request) {
        // $email = $this->profileRepository->profileusermail($request);
        // return $email;
    }

    public function refreshToken(Request $request) {
        // dd($request->Refreshtoken);
        if (is_null($request->Refreshtoken)) {
            return $this->response(['error'=>'Unauthorised'], self::UNAUTHORISED_STATUS_CODE);
        }

        $url = request()->getSchemeAndHttpHost() . "/oauth/token";
        $Oclient = $this->getOClient();
        $formParams = [ 'grant_type'    => 'refresh_token',
                        'refresh_token' =>$request->Refreshtoken,
                        'client_id'     => $Oclient->id,
                        'client_secret' => $Oclient->secret,
                        'scope' => '*'
                      ];

        return $this->sendRequest($url, $formParams);
    }

    public function getAuthUser($access_token) {
        $url = request()->getSchemeAndHttpHost();
            $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$access_token,
                ])->get($url .'/api/user')->json();
                // dd($response);
            return $response;
    }
    public function user()
    {

        $user = auth()->guard('api')->user()->load($this->relation());
        $businesssettings = [];
            $userdata = [
                'user'               =>$user,
                'businesssettings'   =>$businesssettings,
            ];
        return $this->response($userdata, self::SUCCUSUS_STATUS_CODE);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return $this->response(['message' => 'Successfully logged out'], self::SUCCUSUS_STATUS_CODE);
    }

    public function response($data, int $statusCode) {
        $response = ["data"=>$data, "statusCode"=>$statusCode];
        return $response;
    }

    public function getTokenAndRefreshToken(string $email, string $password, string $url) {

        $Oclient = $this->getOClient();
        $formParams =   [
                          'grant_type'    => 'password',
                          'client_id'     => $Oclient->id,
                          'client_secret' => $Oclient->secret,
                          'username'      => $email,
                          'password'      => $password,
                          'scope'         => '',
                          'headers' => [
                              'cache-control' => 'no-cache',
                              'Content-Type'  => 'application/x-www-form-urlencoded'
                          ],
                        ];
        return $this->sendRequest($url, $formParams);
    }

    public function sendRequest(string $url, array $formParams) {
            $Oclient = $this->getOClient();
            $response = Http::asForm()->post($url, $formParams)->json();
            // dd(isset($response['token_type']));
            if(isset($response['token_type'])){//if toekn type exist then proceed
                $userdata = $this->getAuthUser($response['access_token']);

                $data = new stdClass;
                $data->access_token         = $response['access_token'];
                $data->expires_in           = $response['expires_in'];
                $data->refresh_token        = $response['refresh_token'];
                $data->token_type           = $response['token_type'];
                $data->user                 = $userdata['user'];
                $data->businesssettings     = $userdata['businesssettings'];
                $statusCode                 = self::SUCCUSUS_STATUS_CODE;

            }elseif(!isset($response['token_type'])){//no token got, but error
                $statusCode = self::UNAUTHORISED_STATUS_CODE;
                $data = $response['message'];
            }

        return ["data" => $data, "statusCode"=>$statusCode];
    }

    public function getOClient() {
        return OClient::where('password_client', 1)->first();
    }
    public function relation(){
        return [
            'roles',
            'permissions',
            // 'profile'
        ];
    }
}
