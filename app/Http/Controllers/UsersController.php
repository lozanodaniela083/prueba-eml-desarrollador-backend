<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function createUser(Request $request): JsonResponse
    {
        $status = false;
        $result = null;
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status){
            return response()->json(['transaction' => ['status' => $status], 'message' => ['type' => 'success'], 'data' => $user],200);
        }else{
            return response()->json(['transaction' => ['status' => $status], 'message' => ['type' => 'error'], 'data' => $result],500);
        }
    }

    public function editUser(Request $request): JsonResponse
    {
        $status = false;
        $result = null;
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->save();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status){
            return response()->json(['transaction' => ['status' => $status], 'message' => ['type' => 'success'], 'data' => $user],200);
        }else{
            return response()->json(['transaction' => ['status' => $status], 'message' => ['type' => 'error'], 'data' => $result],500);
        }
    }

    public function deleteUser(Request $request): JsonResponse
    {
        $status = false;
        $result = null;
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->delete();

            $status = true;
            DB::commit();
        } catch (\Throwable $th) {
            $result = $th->getMessage();
            DB::rollBack();
        }

        if($status){
            return response()->json(['transaction' => ['status' => $status], 'message' => ['type' => 'success'], 'data' => $user],200);
        }else{
            return response()->json(['transaction' => ['status' => $status], 'message' => ['type' => 'error'], 'data' => $result],500);
        }
    }

    public function getUser(): JsonResponse
    {
        $user = User::orderBy("name", "ASC")->get();

       
            return response()->json(['transaction' => ['status' => true], 'message' => ['type' => 'error'], 'data' => $user],200);
    }
}
