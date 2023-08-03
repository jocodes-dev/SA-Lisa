<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\JenisSuratModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function getAllData()
    {
        $data = User::all();
        if ($data->isEmpty()) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'success get all data',
                'data' => $data
            ]);
        }
    }

    public function createData(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required'
            ],
            [
                'name.required' => 'Form name tidak boleh kosong',
                'email.required' => 'Form email tidak boleh kosong',
                'password.required' => 'Form password tidak boleh kosong',
                'password_confirmation.required' => 'Form password_confirmation tidak boleh kosong',
                'email.email' => 'Mohon isi alamat email dengan format yang benar',
                'email.unique' => 'Email digunakan',
                'password.confirmed' => 'Password tidak sama'
            ]
        );


        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'check your validation',
                'errors' => $validation->errors()
            ]);
        }

        try {
            $data = new User();
            $role = 'user';
            $data->uuid = Uuid::uuid4()->toString();
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->role = $role;
            $data->password = Hash::make($request->input('password'));
            $data->save();
            $token = $data->createToken('auth_token')->plainTextToken;
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success create data',
            'data' => $data,
            'access token' => $token
        ]);
    }

    public function getDataByUuid($uuid)
    {
        if (!Uuid::isValid($uuid)) {
            return response()->json([
                'code' => 400,
                'message' => 'Uuid is failed',
            ]);
        }

        $data = User::where('uuid', $uuid)->first();
        if (!$data) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found',
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'Success get data by Uuid',
                'data' => $data
            ]);
        }
    }

    public function updateDataByUuid(Request $request, $uuid)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required'
            ],
            [
                'name.required' => 'Form name tidak boleh kosong',
                'email.required' => 'Form email tidak boleh kosong',
                'password.required' => 'Form password tidak boleh kosong',
                'password_confirmation.required' => 'Form password_confirmation tidak boleh kosong',
                'email.email' => 'Mohon isi alamat email dengan format yang benar',
                'email.unique' => 'Email digunakan',
                'password.confirmed' => 'Password tidak sama'
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'check your validation',
                'errors' => $validation->errors()
            ]);
        }

        try {
            $data = User::where('uuid', $uuid)->firstOrFail();
            $role = 'user';
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->role = $role;
            $data->password = Hash::make($request->input('password'));
            $data->save();
            $token = $data->createToken('auth_token')->plainTextToken;
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success update data',
            'data' => $data,
            'access token' => $token
        ]);
    }

    public function deleteData($uuid)
    {
        if (!Uuid::isValid($uuid)) {
            return response()->json([
                'code' => 404,
                'message' => 'Data Not Found',
            ]);
        }

        try {
            $data = User::where('uuid', $uuid)->first();
            if (!$data) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data Not Found',
                ]);
            }
            $data->tokens()->delete();
            $data->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed to delete data',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Delete data success'
        ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi ' . $user->name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function logout(Request $request)
    {

        try {
            $request->user('web')->tokens()->delete();

            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'code' => 200,
                'message' => 'Logged out successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ]);
        }
    }
}
