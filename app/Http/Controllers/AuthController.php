<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use app\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validate = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'notif' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {
            $credentials = request(['email', 'password']);
            $credentials = Arr::add($credentials, 'notif', 'aktif');
            if (!Auth::attempt($credentials)) {
                $respon = [
                    'notif' => 'error',
                    'msg' => 'Unathorized',
                    'errors' => null,
                    'content' => null,

                ];
                return response()->json($respon, 401);
            }

            $user = User::where('email', $request->email)->first();
            if (! \Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'notif' => 'success',
                'msg' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'notif_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'city' => $request->city,
                'photo1' => $request->photo1,
                'photo2' => $request->photo2,
                'photo3' => $request->photo3,
                'photo4' => $request->photo4,
                'about' => $request->about,
                'age' => $request->age,
                'zodiac' => $request->zodiac,
                'drink' => $request->drink,
                'gym' => $request->gym,
                'smoke' => $request->smoke,
                'status' => $request->status,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'isFriend' => $request->isFriend,
                'interest' => $request->interest,
            ];
            return response()->json($respon, 200);
        }
    }

    public function getUser(Request $request)
    {
        // $findUser =
        $user = User::find(auth()->id());
        return response()->json([
            'user' => $user,
            'token' => $user->tokens()->orderBy('id', 'desc')->first()
        ]);
        // return

    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        $respon = [
            'notif' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }

    public function logoutall(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();
        $respon = [
            'notif' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
}
