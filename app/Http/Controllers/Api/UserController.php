<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
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
        $users = SysUser::withCount('pinjam')->where('level', 0)->get();

        //return collection of users
        return $this->successResponse($users, 200);
    }

    public function show($id): JsonResponse
    {
        //find users by ID
        $users = SysUser::find($id);

        //return single users 
        return $this->successResponse($users, 200);
    }

    public function store(UserRequest $request): JsonResponse
    {

        //create users
        $users = SysUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('nopassword'),
            'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
            'level' => 0,
        ]);

        //return response
        return $this->successResponse($users, 200);
    }

    public function update(UserRequest $request, $id): JsonResponse
    {
        //find book by ID
        $book = SysUser::find($id);

        //update book with new image
        $book->update([
            'name' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
        ]);

        //return response
        return $this->successResponse($book, 200);
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
