<?php

namespace App\Http\Controllers\v1\Auth;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ReferralCodes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User as UserResource;
use App\Notifications\UserVerifyNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Auth\RegisterNewCustomerRequest;

class RegisterController extends Controller
{
    /**
     * Register
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerNewCustomer(RegisterNewCustomerRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'first_name'=>'required',
        //     'last_name'=>'required',
        //     'mobile'=>'required',
        //     'cover'=>'required',
        //     'country_code'=>'required',
        //     'password' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 500);
        // }

        $data = User::where('email', $request->email)->where('mobile' , $request->mobile)->where('country_code' , $request->country_code)->first();
        // dump($data);
        // dump($request->channel);
        // if (is_null($request->channel) || !$request->channel) {
        //     $request->channel = 'web';
        // }
        if (is_null($data) || !$data) {
            $user = User::create([
                'email' => $request->email,
                'mobile'=> $request->mobile,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'type' => 'customer',
                'status' => 1,
                'channel' => $request->channel,
                'country_code' => $request->country_code,
            ]);

            // Add loan to currency
            $user->deposit(20000);

            $token = $user->createToken($request->channel);
            $token = $token->plainTextToken;

            function clean($string) {
                $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
            }
            function generateRandomString($length = 14) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
            
            $code = generateRandomString(13);
            $code  = strtoupper($code);
            ReferralCodes::create(['uid'=>$user->id,'code'=>$code]);
            Auth::login($user);
            return response()->json(['user'=>$user,'token'=>$token,'status'=>200], 200);
        }

        $response = [
            'success' => false,
            'message' => $request->attributes,
            'status' => 500
        ];
        return response()->json($response, 500);
    }

    public function createStoreProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'country_code'=>'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 500);
        }
        $emailValidation = User::where('email',$request->email)->first();

        if (is_null($emailValidation) || !$emailValidation) {
            $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
            $data = User::where($matchThese)->first();
            if (is_null($data) || !$data) {
                $user = User::create([
                    'email' => $request->email,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'type'=>'store',
                    'status'=>1,
                    'mobile'=>$request->mobile,
                    'lat'=>0,
                    'lng'=>0,
                    'cover'=>'NA',
                    'country_code'=>$request->country_code,
                    'gender'=>1,
                    'dob'=>'1997-07-15',
                    'password' => Hash::make($request->password),
                ]);

                $token = $user()->createToken($request->channel);
                $token = $token->plainTextToken;
                return response()->json(['user'=>$user,'token'=>$token,'status'=>200], 200);
            }
        }
    }

    public function create_admin_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'country_code'=>'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 500);
        }
        $emailValidation = User::where('email',$request->email)->first();
        if (is_null($emailValidation) || !$emailValidation) {

            $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
            $data = User::where($matchThese)->first();
            if (is_null($data) || !$data) {
                $checkExistOrNot = User::where('type','=','admin')->first();

                if (is_null($checkExistOrNot)) {
                    $user = User::create([
                        'email' => $request->email,
                        'first_name'=>$request->first_name,
                        'last_name'=>$request->last_name,
                        'type'=>'admin',
                        'status'=>1,
                        'mobile'=>$request->mobile,
                        'lat'=>0,
                        'lng'=>0,
                        'cover'=>'NA',
                        'country_code'=>$request->country_code,
                        'gender'=>1,
                        'dob'=>'1997-07-15',
                        'password' => Hash::make($request->password),
                    ]);

                    $token = Auth::user()->createToken($request->channel)->plainTextToken;
                    return response()->json(['user'=>$user,'token'=>$token,'status'=>200], 200);
                }

                $response = [
                    'success' => false,
                    'message' => 'Account already setuped',
                    'status' => 500
                ];
                return response()->json($response, 500);
            }

            $response = [
                'success' => false,
                'message' => 'Mobile is already registered.',
                'status' => 500
            ];
            return response()->json($response, 500);
        }
        $response = [
            'success' => false,
            'message' => 'Email is already taken',
            'status' => 500
        ];
        return response()->json($response, 500);
    }

    public function adminNewAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'mobile'=>'required',
            'country_code'=>'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Validation Error.', $validator->errors(),
                'status'=> 500
            ];
            return response()->json($response, 500);
        }
        $emailValidation = User::where('email',$request->email)->first();
        if (is_null($emailValidation) || !$emailValidation) {

            $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
            $data = User::where($matchThese)->first();
            if (is_null($data) || !$data) {
                $user = User::create([
                    'email' => $request->email,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'type'=>'admin',
                    'status'=>1,
                    'mobile'=>$request->mobile,
                    'lat'=>0,
                    'lng'=>0,
                    'cover'=>'NA',
                    'country_code'=>$request->country_code,
                    'gender'=>1,
                    'dob'=>'1997-07-15',
                    'password' => Hash::make($request->password),
                ]);

                $token = Auth::user()->createToken($request->channel)->plainTextToken;
                return response()->json(['user'=>$user,'token'=>$token,'status'=>200], 200);
            }

            $response = [
                'success' => false,
                'message' => 'Mobile is already registered.',
                'status' => 500
            ];
            return response()->json($response, 500);
        }
        $response = [
            'success' => false,
            'message' => 'Email is already taken',
            'status' => 500
        ];
        return response()->json($response, 500);
    }
}
