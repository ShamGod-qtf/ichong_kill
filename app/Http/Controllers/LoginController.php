<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    // 用户登录
    public function login(Request $request)
    {
        $body = $request->post();

        $token = Auth::guard('api')->attempt($body);

        if (!$token) {
            abort(403,'用户名或密码错误');
        }

        return [
            'data' => [
                'manage' => $body['name'],
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]
        ];
    }
}
