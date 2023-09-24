<?php

namespace App\Http\Controllers\API\AUTH;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\UserPasswordResetRequest;
use App\Repositories\User\UserRepositoryInterface;

class AuthController extends Controller
{
         const SUCCUSUS_STATUS_CODE = 200;
        const UNAUTHORISED_STATUS_CODE = 401;

        protected $userRepository;

        public function __construct(UserRepositoryInterface $userRepository) {
            $this->userRepository = $userRepository;
        }

        public function login(UserLoginRequest $request) {
            $response = $this->userRepository->login($request);
            return response()->json($response["data"], $response["statusCode"]);
        }

        public function register(UserRegisterRequest $request) {
            $response = $this->userRepository->register($request);
            return response()->json($response["data"], $response["statusCode"]);
        }

        public function user() {
            $response = $this->userRepository->user();
            return response()->json([
                'user'                    => $response['data']["user"],
                'businesssettings'        => $response['data']["businesssettings"],
            ], $response["statusCode"]);
        }

        public function logout(Request $request) {
            $response = $this->userRepository->logout($request);
            return response()->json($response["data"], $response["statusCode"]);
        }

        public function refreshToken(Request $request) {
            $response = $this->userRepository->refreshToken($request);
            return response()->json($response["data"], $response["statusCode"]);
        }
        public function passwordresetform(UserPasswordResetRequest $request) {
            $response = $this->userRepository->submitPasswordResetForm($request);
            // dd($response);
            return response()->json([
                'email'                    => $response['data']["email"],
            ], $response["statusCode"]);
        }
        public function passwordreset(PasswordResetRequest $request) {
            $response = $this->userRepository->PasswordReset($request);
            // dd($response);
            return response()->json([
                'email'                    => $response['data']["email"],
            ], $response["statusCode"]);
        }
}
