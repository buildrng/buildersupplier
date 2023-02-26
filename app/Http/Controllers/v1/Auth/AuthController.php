<?php

namespace App\Http\Controllers\v1\Auth;

// use Config;
use Exception;
use App\Models\Otp;
use App\Models\User;
use App\Models\Drivers;
use App\Models\General;
use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\AuthFirebaseRequest;
use App\Http\Requests\Auth\AuthAdminLoginRequest;
use App\Http\Requests\Auth\AuthDriverLoginRequest;
use App\Http\Requests\Auth\AuthVerifyEmailRequest;
use App\Http\Requests\Auth\AuthVerifyPhoneRequest;
use App\Http\Requests\Auth\AuthCustomerLoginRequest;
use App\Http\Requests\Auth\AuthDriverPhoneOtpRequest;
use App\Http\Requests\Auth\AuthCustomerPhoneOtpRequest;
use App\Http\Requests\Auth\AuthDriverPhoneLoginRequest;
use App\Http\Requests\Auth\AuthCustomerPhoneLoginRequest;
use App\Http\Requests\Auth\AuthFirebaseVerifyPhoneRequest;

class AuthController extends Controller
{
    public function loginCustomer(AuthCustomerLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        // Account Validation
        if (!(new BcryptHasher)->check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Email or password is incorrect. Authentication failed.'], 401);
        }

        // Login Attempt
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            // Authentication was successful...
            // $credentials = $request->only('email', 'password');
            try
            {
                // Generate token
                $token_name = $request->channel;
                $token = $user->createToken($token_name)->plainTextToken;

                if (! $token) {
                    //     JWTAuth::factory()->setTTL(40320); // Expired Time 28day
                    return response()->json(['error' => 'invalid_credentials'], 401);
                }
            } catch (Exception $e) {
                // JWTException
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
            return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
        }
    }

    public function loginDrivers(AuthDriverLoginRequest $request)
    {
        // Config::set('auth.providers.driver.model', \App\Models\Drivers::class);
        $user = Drivers::where('email', $request->email)->first();
        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        // Account Validation
        if (!(new BcryptHasher)->check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Email or password is incorrect. Authentication failed.'], 401);
        }

        // Login Attempt
        $credentials = $request->only('email', 'password');
        try
        {
            // Generate token
            $token_name = $user->type;
            $token = $user->createToken($token_name)->plainTextToken;

            if (! $token = $token->plainTextToken) {
                //     JWTAuth::factory()->setTTL(40320); // Expired Time 28day
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
    }

    public function adminLogin(AuthAdminLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        // Account Validation
        if (!(new BcryptHasher)->check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Email or password is incorrect. Authentication failed.'], 401);
        }

        if($user->type !='admin'){
            return response()->json(['error' => 'access denied'], 401);
        }

        // Login Attempt
        $credentials = $request->only('email', 'password');

        try
        {
            // Generate token
            $token = $user->createToken($user->type)->plainTextToken;

            if (! $token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
    }

    public function loginWithPhonePassword(AuthCustomerPhoneLoginRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        //     'password'=>'required'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = User::where($matchThese)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        // Account Validation
        if (!(new BcryptHasher)->check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Phone Number or password is incorrect. Authentication failed.'], 401);
        }

        // Login Attempt
        $credentials = $request->only('country_code','mobile', 'password');

        try
        {
            // Generate token
            $token_name = $user->type;
            $token = $user->createToken($token_name)->plainTextToken;

            if (! $token = $token->plainTextToken) {
                //     JWTAuth::factory()->setTTL(40320); // Expired Time 28day
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
    }

    public function loginWithPhonePasswordDrivers(AuthDriverPhoneLoginRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        //     'password'=>'required'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = Drivers::where($matchThese)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        // Account Validation
        if (!(new BcryptHasher)->check($request->input('password'), $user->password)) {

            return response()->json(['error' => 'Phone Number or password is incorrect. Authentication failed.'], 401);
        }

        // Login Attempt
        $credentials = $request->only('country_code','mobile', 'password');

        try
        {
            // Generate token
            $token_name = $user->type;
            $token = $user->createToken($token_name)->plainTextToken;

            if (! $token = $token->plainTextToken) {
                //     JWTAuth::factory()->setTTL(40320); // Expired Time 28day
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);

        }
        return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
    }

    public function firebaseauth(AuthFirebaseRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $url = url('/api/v1/success_verified');
        return view('fireauth',['mobile'=>$request->mobile,'redirect'=>$url]);
    }

    public function success_verified()
    {
        return view('verified');
    }

    public function verifyPhoneForFirebaseRegistrations(AuthFirebaseVerifyPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'country_code'=>'required',
        //     'mobile'=>'required'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = User::where('email',$request->email)->first();
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $data2 = User::where($matchThese)->first();
        if (is_null($data) && is_null($data2)) {
            $response = [
                'data'=>true,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }

        $response = [
            'data' => false,
            'message' => 'email or mobile is already registered',
            'status' => 500
        ];
        return response()->json($response, 200);
    }

    public function verifyEmailForReset(AuthVerifyEmailRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['email' => $request->email];

        $user = User::where($matchThese)->first();

        if(!$user) return response()->json(['data'=>false,'error' => 'User not found.'], 500);

        $settings = Settings::take(1)->first();
        $generalInfo = General::take(1)->first();
        $mail = $request->email;
        $username = $request->email;
        $subject = 'Reset Password';
        $otp = random_int(100000, 999999);
        $savedOTP = Otp::create([
            'otp'=>$otp,
            'email'=>$request->email,
            'status'=>0,
        ]);
        $mailTo = Mail::send('mails/reset',
            [
                'app_name'      =>$generalInfo->name,
                'otp'          => $otp
            ]
            , function($message) use($mail,$username,$subject,$generalInfo){
            $message->to($mail, $username)
            ->subject($subject);
            $message->from($generalInfo->email,$generalInfo->name);
        });

        $response = [
            'data'=>true,
            'mail'=>$mailTo,
            'otp_id'=>$savedOTP->id,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);

    }

    public function verifyEmailForResetDriver(AuthVerifyEmailRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['email' => $request->email];

        $user = Drivers::where($matchThese)->first();

        if(!$user) return response()->json(['data'=>false,'error' => 'User not found.'], 500);

        $settings = Settings::take(1)->first();
        $generalInfo = General::take(1)->first();
        $mail = $request->email;
        $username = $request->email;
        $subject = 'Reset Password';
        $otp = random_int(100000, 999999);
        $savedOTP = Otp::create([
            'otp'=>$otp,
            'email'=>$request->email,
            'status'=>0,
        ]);
        $mailTo = Mail::send('mails/reset',
            [
                'app_name'      =>$generalInfo->name,
                'otp'          => $otp
            ]
            , function($message) use($mail,$username,$subject,$generalInfo){
            $message->to($mail, $username)
            ->subject($subject);
            $message->from($generalInfo->email,$generalInfo->name);
        });

        $response = [
            'data'=>true,
            'mail'=>$mailTo,
            'otp_id'=>$savedOTP->id,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);

    }

    public function verifyPhoneForFirebase(AuthVerifyPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = User::where($matchThese)->first();

        if(!$user) return response()->json(['data'=>false,'error' => 'User not found.'], 500);
        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function verifyPhoneForFirebaseNew(AuthVerifyPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = User::where($matchThese)->first();

        if(!$user){
            $response = [
                'data'=>true,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        return response()->json(['data'=>false,'error' => 'Phone exist'], 500);

    }

    public function verifyPhoneForFirebaseDriver(AuthVerifyPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = Drivers::where($matchThese)->first();

        if(!$user) return response()->json(['data'=>false,'error' => 'User not found.'], 500);
        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function verifyPhoneForFirebaseDriverNew(AuthVerifyPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = Drivers::where($matchThese)->first();

        if(!$user){
            $response = [
                'data'=>true,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        return response()->json(['data'=>false,'error' => 'Phone exist'], 500);
    }

    public function loginWithMobileOtp(AuthCustomerPhoneOtpRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = User::where($matchThese)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        try
        {
            // Generate token
            $token_name = $user->type;
            $token = $user->createToken($token_name)->plainTextToken;

            if (! $token = $token->plainTextToken) {
                //     JWTAuth::factory()->setTTL(40320); // Expired Time 28day
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
    }

    public function loginWithMobileOtpDriver(AuthDriverPhoneOtpRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'mobile' => 'required',
        //     'country_code'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];

        $user = Drivers::where($matchThese)->first();

        if(!$user) return response()->json(['error' => 'User not found.'], 500);

        try
        {
            // Generate token
            $token_name = $user->type;
            $token = $user->createToken($token_name)->plainTextToken;

            if (! $token = $token->plainTextToken) {
                //     JWTAuth::factory()->setTTL(40320); // Expired Time 28day
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(['user' => $user,'token'=>$token,'status'=>200], 200);
    }
}
