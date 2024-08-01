<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponses;
use App\Models\SysUser;



class AuthController extends Controller
{
    use ApiResponses;

    public function register(RegisterRequest $request): JsonResponse
    {
        
        $formData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'tanggal_lahir' => date('Y-m-d h:i:s', strtotime($request->tanggal_lahir)),
            'level' => 1,
        ];
        $formData['password'] = bcrypt($request->password);
  
        $user = SysUser::create($formData);  
        $data = $user;
        $data->token = $user->createToken('Razin')->accessToken;
  
        return $this->successResponse($data, 200);
          
    }
  
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];
  
        if (Auth::attempt($credentials)) 
        {
            $data = Auth::user();
            $data->token = Auth::user()->createToken('Razin')->accessToken;
            return $this->successResponse($data, 200);
        }
  
        return $this->unauthorizedResponse('Error', 'Unauthorized');
  
    }
}
