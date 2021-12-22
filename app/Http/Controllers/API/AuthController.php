<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\Customer;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:customer',
            'password'  => 'required|string|min:6',
            'birthdate' => 'required|date',
            'gender'    => 'required',
            'weight'    => 'required',
            'height'    => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());       
        }

        $customer = Customer::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
            'weight'    => $request->weight,
            'height'    => $request->height,
         ]);

        $token = $customer->createToken('auth_token')->plainTextToken;

        $response = [
            'status'    => 'success',
            'message'   => 'Register successfully',
            'content'   => [
                'data'          => $customer,
                'access_token'  => $token,
                'token_type'    => 'Bearer',
            ]
        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        if (!Auth::guard('api')->attempt($request->only('email', 'password')))
        {
            return response()->json(
            [
                'status'    => 'error',
                'message'   => 'Unauthorized'
            ], 401);
        }

        $customer = Customer::where('email', $request['email'])->firstOrFail();

        $token = $customer->createToken('auth_token')->plainTextToken;

        $response = [
            'status'    => 'success',
            'message'   => 'Login successfully',
            'content'   => [
                'data'          => $customer,
                'access_token'  => $token,
                'token_type'    => 'Bearer',
            ]
        ];
        
        return response()->json($response, 200);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'status'    => 'success',
            'message'   => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}