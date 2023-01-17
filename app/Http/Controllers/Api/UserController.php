<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     *
     * Add New User
     *
     **/

    public function createUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email|unique:users,email',
                'name' => 'required',
                'date_of_birth' => 'required',
                'phone' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } ## end register

    /**
     *
     * Login The User
     *
     **/
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } ## end login


    public function getUser(Request $request){
        try {
            $validateUser = Validator::make($request->all(),
            [
                'id' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status'     => false,
                    'message'    => 'validation error',
                    'errors'     => $validateUser->errors()
                ], 401);
            }

            $user = User::where('id', $request->id)->firstOrFail();

            return response()->json([
                'status'    => true,
                'message'   => 'User exists!',
                'data'      => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'    => false,
                'message'   => 'No Such User Exists'
            ], 500);
        }
    } ## end get user

    public function getAllUsers(){
        try {

            $users = User::all();

            if(!$users){
                return response()->json([
                    'status'    => false,
                    'message'   => 'Users Table is Empty',
                ], 200);
            }

            return response()->json([
                'status'    => true,
                'message'   => 'All users',
                'data'      => $users
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'    => false,
                'message'   => $th->getMessage()
            ], 500);
        }
    } ## end get all users

    public function updateUser($id,Request $request)
    {
        try {

            $validateUser = Validator::make($request->all(),
            [
                'email' => 'email|unique:users,email',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::find($id);
            if(!$user){
                return response()->json([
                    'status' => false,
                    'message'   => 'No Such User Exists'
                ], 401);
            }

            $user->update([
                'email' => $request->email ?? $user->email,
                'name' => $request->name ?? $user->name,
                'date_of_birth' => $request->date_of_birth ?? $user->date_of_birth,
                'phone' => $request->phone ?? $user->phone,
                'password' => $request->password ? Hash::make($request->password) : $user->password
            ]);


            return response()->json([
                'status'    => true,
                'message'   => 'User Updated Successfully',
                'data'      => $user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    } ## end update user

    public function deleteUser($id){
        try {

            $user = User::find($id);
            $user->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'User has been delete successfully',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status'    => false,
                'message'   => 'No Such User exists'
            ], 500);
        }
    } ## end delete user

} ## End Class
