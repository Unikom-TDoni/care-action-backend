<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
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
        ]);

        if($validator->fails())
        {
            $response = [
                'status'    => 'error',
                'message'   => $validator->errors()->first()
            ];

            return response()->json($response, 400);       
        }

        $customer = Customer::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'birthdate' => $request->birthdate,
            'gender'    => $request->gender,
            'weight'    => $request->weight,
            'height'    => $request->height,
            'picture'   => null,
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
        $validator = Validator::make($request->all(),[
            'email'     => 'required|string|email',
            'password'  => 'required|string',
        ]);

        if($validator->fails())
        {
            $response = [
                'status'    => 'error',
                'message'   => $validator->errors()->first()
            ];

            return response()->json($response, 400);       
        }

        if (!Auth::guard('customer')->attempt($request->only('email', 'password')))
        {
            return response()->json(
            [
                'status'    => 'error',
                'message'   => 'Unauthorized'
            ], 401);
        }

        $customer = Customer::where('email', $request['email'])->firstOrFail();
        $customer->picture = ($customer->picture != "")?URL::asset('images/customer').'/'.$customer->picture:"";

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