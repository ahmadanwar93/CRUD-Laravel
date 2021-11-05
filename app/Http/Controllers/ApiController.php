<?php

namespace App\Http\Controllers;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class ApiController extends Controller
{
    //
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // tukar jwt auth sini
        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }
    // aku try sendiri
    public function dashboard(Request $request){
        $user_total = User::count();
        $code=0;
        return response()->json(
            compact('user_total','code')
        );
        }
    // aku try sendir
    protected function createNewToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()*60,
            'user'=>auth()->user()
        ]);
    }
}
