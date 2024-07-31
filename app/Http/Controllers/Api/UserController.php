<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use App\Models\SysUser;

class UserController extends Controller
{
    use ApiResponses;

    public function index(): JsonResponse
    {
        //get all users
        $users = SysUser::get();

        //return collection of users
        return $this->successResponse($users, 200);
    }

    public function destroy($id)
    {

        //find user by ID
        $user = SysUser::find($id);

        //delete user
        $user->delete();

        //return response
        return $this->successResponse(null, 200);
    }

}
