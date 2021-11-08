<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\UserResource;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Traits\JsonTrait;

class ApiController extends Controller
{   
    // use JsonTrait;
    //
    /**
     * Login
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return $this->jsonSuccessResponse(
                $validator->errors(),
                'Invalid Input Parameters',
            422);
        }
        // tukar jwt auth sini
        if (! $token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }
    /** 
     * User API 
     * Get all the user by pagination
     * @authenticated
     * @header Authorization Bearer {{token}}
     * @bodyParam page int Page number for pagination. Example: 1
     * 
     **/

    public function users(){
        // 
        
        $response = Gate::inspect('update', auth()->user());
        // $users = User::paginate(10);
        $users = User::where('id',2)->first();
        // $users = User::where('id','<',7)->first();
        // return $this->jsonSuccessResponse(compact('users'),'');
        return $this->jsonSuccessResponse(
            new UserResource($users),''
        );
        // return $this->jsonSuccessResponse(
        //     UserResource::collection($users),''
        // ); // salah lagi collection aku
    }

    /**
      * Dashboard  
     * @authenticated
     * @header Authorization Bearer {{token}}
     * @response 401 scenario = "invalid token"
    */
    public function dashboard(Request $request){
        $user_total = User::count();
        $code=0;
        $employee = Employee::whereId(1) -> first();
        // return $this->jsonSuccessResponse(compact('user_total','code'),'',200);
        // return response()->json(
        //     compact('user_total','code')
        // );

        return $this->jsonSuccessResponse(compact('user_total','code'),'',200);
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
