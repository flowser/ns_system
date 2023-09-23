<?php

namespace App\Http\Controllers\API\AUTH;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Repositories\User\UserRepositoryInterface;

class AuthController extends Controller
{
    const SUCCUSUS_STATUS_CODE = 200;
        const UNAUTHORISED_STATUS_CODE = 401;

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
}
