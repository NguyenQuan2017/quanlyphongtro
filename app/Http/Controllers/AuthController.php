<?php

namespace App\Http\Controllers;

use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Create a new AuthController instance
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','check-login']]);
    }

    public function login(LoginRequest $loginRequest)
    {
        $validated = $loginRequest->validated();
        if(!$token = auth()->attempt($validated)) {
            return $this->errorResponse(['Email hoặc mật khẩu không đúng'],401);
        }
        return $this->createNewToken($token);
    }

    protected function createNewToken($token)
    {
        $data = [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'user' => auth()->user()
        ];
        return $this->successResponse($data);
    }

    public function register(RegisterRequest $registerRequest)
    {
        $validated = $registerRequest->validated();
        $data = array_merge($validated,['password' => bcrypt($registerRequest['password'])]);
        try {
            $exist_emails = User::where('email', $registerRequest['email'])->first();
            if ($exist_emails) {
              return $this->errorResponse(['Địa chỉ email đã tồn tại']);
            }
            $user = User::create($data);
            return $this->successResponse($user,'Dang ky thanh cong',201);
        }catch (\Exception $e) {

        }
    }

    public function logout()
    {
        auth()->logout();
        return $this->successResponse([],'Dang xuat thanh cong');
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return $this->successResponse(auth()->user());
    }

    public function changePassWord(changePasswordRequest $changePasswordRequest) {
        $data = $changePasswordRequest->validated();
        $userId = auth()->user()->id;
        User::where('id', $userId)->update(
            ['password' => bcrypt($data['new_password'])]
        );

        return $this->successResponse([],'Thay doi mat khau thanh cong',201);
    }

    public function checkLogin() {
        return $this->successResponse(['isLogin' => auth()->check()]);
    }
}
