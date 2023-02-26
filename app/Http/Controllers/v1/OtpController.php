<?php

namespace App\Http\Controllers\v1;

use DB;
use Config;
use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Models\Drivers;
// use JWTAuth;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Requests\OtpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVfileRequest;
use App\Http\Requests\OtpByIdRequest;
use App\Http\Requests\OtpTempTokenRequest;
use App\Http\Requests\OtpTokenRequest;
use App\Http\Requests\OtpVerificationRequest;
use App\Http\Requests\OtpVerificationResetRequest;
use App\Http\Requests\OtpViaEmailRequest;

class OtpController extends Controller
{
    public function save(OtpRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'otp' => 'required',
        //     'email' => 'required',
        //     'status' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Otp::create($request->all());
        if (is_null($data)) {
            $response = [
            'data'=>$data,
            'message' => 'error',
            'status' => 500,
        ];
        return response()->json($response, 200);
        }
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getById(OtpByIdRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Otp::find($request->id);

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function update(OtpByIdRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $data = Otp::find($request->id)->update($request->all());

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function delete(OtpByIdRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $data = Otp::find($request->id);
        if ($data) {
            $data->delete();
            $response = [
                'data'=>$data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'message' => 'Data not found.',
            'status' => 404
        ];
        return response()->json($response, 404);
    }

    public function verifyOTP(OtpVerificationRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        //     'otp'=>'required'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $match =  ['otp'=>$request->otp,'id'=>$request->id,'status'=>0];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $data->update(['status'=>1]);

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function verifyOTPReset(OtpVerificationResetRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        //     'otp'=>'required',
        //     'type'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $match =  ['otp'=>$request->otp,'id'=>$request->id,'status'=>0];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $data->update(['status'=>1]);
        $token = '';
        if($request->type == 'email'){
            $user = User::where('email',$request->email)->first();
            try {
                // JWTAuth::factory()->setTTL(10); // Expired Time 28days
                // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

                // return response()->json(['error' => 'invalid_credentials'], 401);
                // }
            } catch (Exception $e) {
                //         // JWTException
                //         return response()->json(['error' => 'could_not_create_token'], 500);
                    // }
            }

            if($request->type == 'phone'){
                $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
                $user = User::where($matchThese)->first();
                try {
                    // JWTAuth::factory()->setTTL(10); // Expired Time 28days

                    // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

                    //     return response()->json(['error' => 'invalid_credentials'], 401);

                    // }
                } catch (Exception $e) {
                    // JWTException
                    return response()->json(['error' => 'could_not_create_token'], 500);
                }
            }

            $response = [
                'data'=>$data,
                'temp'=>$token,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
    }

    public function verifyOTPResetDriver(OtpVerificationResetRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        //     'otp'=>'required',
        //     'type'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $match =  ['otp'=>$request->otp,'id'=>$request->id,'status'=>0];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $data->update(['status'=>1]);
        $token = '';
        if($request->type == 'email'){

            $user = Drivers::where('email',$request->email)->first();
            try {
                // JWTAuth::factory()->setTTL(10); // Expired Time 28days
                // Config::set('auth.providers.driver.model', \App\Models\Drivers::class);
                // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

                //     return response()->json(['error' => 'invalid_credentials'], 401);
                // }
            } catch (Exception $e) {
                // JWTException
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
        }

        if($request->type == 'phone'){
            $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
            $user = Drivers::where($matchThese)->first();
            try {
                // JWTAuth::factory()->setTTL(10); // Expired Time 28days

                // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

                //     return response()->json(['error' => 'invalid_credentials'], 401);

                // }
            } catch (Exception $e) {
                // JWTException
                return response()->json(['error' => 'could_not_create_token'], 500);
            }
        }

        $response = [
            'data'=>$data,
            'temp'=>$token,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function generateTempTokenEmail(OtpViaEmailRequest $request){
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
        try {
            // JWTAuth::factory()->setTTL(10); // Expired Time 28days

            // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

            //     return response()->json(['error' => 'invalid_credentials'], 401);

            // }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // $response = [
        //     'temp'=>$token,
        //     'success' => true,
        //     'status' => 200,
        // ];
        // return response()->json($response, 200);
    }

    public function generateTempToken(OtpTokenRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'country_code' => 'required',
        //     'mobile'=>'required',
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
        try {
        //     JWTAuth::factory()->setTTL(10); // Expired Time 28days

            // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

            //     return response()->json(['error' => 'invalid_credentials'], 401);

        // }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // $response = [
        //     'temp'=>$token,
        //     'success' => true,
        //     'status' => 200,
        // ];
        // return response()->json($response, 200);
    }

    public function generateTempTokenDriver(OtpTokenRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'country_code' => 'required',
        //     'mobile'=>'required',
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
        try {
            // JWTAuth::factory()->setTTL(10); // Expired Time 28days
            // Config::set('auth.providers.driver.model', \App\Models\Drivers::class);
            // if (! $token = JWTAuth::fromUser($user, ['exp' => Carbon::now()->addMinutes(5)->timestamp])) {

            //     return response()->json(['error' => 'invalid_credentials'], 401);

            // }
        } catch (Exception $e) {
            // JWTException
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // $response = [
        //     'temp'=>$token,
        //     'success' => true,
        //     'status' => 200,
        // ];
        // return response()->json($response, 200);
    }

    public function getAll(){
        $data = Otp::all();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function verifyPhone(OtpTokenRequest $request){
        // $validator = Validator::make($request->all(), [
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

        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $data= User::where($matchThese)->first();
        if (is_null($data)) {
            return response()->json(['error' => 'User not found.'], 500);
        }

        $settings = Settings::take(1)->first();
        if($settings->sms_name =='0'){ // send with twillo
            $payCreds = DB::table('settings')
            ->select('*')->first();
            if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->sms_creds);
            if(is_null($credsData) || is_null($credsData->twilloCreds) || is_null($credsData->twilloCreds->sid)){
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }

            $id = $credsData->twilloCreds->sid;
            $token = $credsData->twilloCreds->token;
            $url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
            $from = $credsData->twilloCreds->from;
            $to = $request->country_code.$request->mobile; // twilio trial verified number
            try{
                $otp = random_int(100000, 999999);
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $url, [
                    'headers' =>
                    [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
                    'Body' => 'Your Verification code is : '.$otp, //set message body
                    'To' => $to,
                    'From' => $from //we get this number from twilio
                    ],
                    'auth' => [$id, $token, 'basic']
                    ]
                );
                $savedOTP = Otp::create([
                    'otp'=>$otp,
                    'email'=>$to,
                    'status'=>0,
                ]);
                $response = [
                    'data'=>true,
                    'otp_id'=>$savedOTP->id,
                    'success' => true,
                    'status' => 200,
                ];
                return response()->json($response, 200);
            }catch (Exception $e){
                echo "Error: " . $e->getMessage();
            }

        }else{ // send with msg91
            $payCreds = DB::table('settings')
            ->select('*')->first();
            if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->sms_creds);
            if(is_null($credsData) || is_null($credsData->msg) || is_null($credsData->msg->key)){
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $clientId = $credsData->msg->key;
            $smsSender = $credsData->msg->sender;
            $otp = random_int(100000, 999999);
            $client = new \GuzzleHttp\Client();
            $to = $request->country_code.$request->mobile;
            $res = $client->get('http://api.msg91.com/api/sendotp.php?authkey='.$clientId.'&message=Your Verification code is : '.$otp.'&mobile='.$to.'&sender='.$smsSender.'&otp='.$otp);
            $data = json_decode($res->getBody()->getContents());
            $savedOTP = Otp::create([
                'otp'=>$otp,
                'email'=>$to,
                'status'=>0,
            ]);
            $response = [
                'data'=>true,
                'otp_id'=>$savedOTP->id,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
    }

    public function verifyPhoneNew(OtpTokenRequest $request){
        // $validator = Validator::make($request->all(), [
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

        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $data= User::where($matchThese)->first();
        if (is_null($data)) {
            $settings = Settings::take(1)->first();
            if($settings->sms_name =='0'){ // send with twillo
                $payCreds = DB::table('settings')
                ->select('*')->first();
                if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }
                $credsData = json_decode($payCreds->sms_creds);
                if(is_null($credsData) || is_null($credsData->twilloCreds) || is_null($credsData->twilloCreds->sid)){
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }

                $id = $credsData->twilloCreds->sid;
                $token = $credsData->twilloCreds->token;
                $url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
                $from = $credsData->twilloCreds->from;
                $to = $request->country_code.$request->mobile; // twilio trial verified number
                try{
                    $otp = random_int(100000, 999999);
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' =>
                        [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                        'form_params' => [
                        'Body' => 'Your Verification code is : '.$otp, //set message body
                        'To' => $to,
                        'From' => $from //we get this number from twilio
                        ],
                        'auth' => [$id, $token, 'basic']
                        ]
                    );
                    $savedOTP = Otp::create([
                        'otp'=>$otp,
                        'email'=>$to,
                        'status'=>0,
                    ]);
                    $response = [
                        'data'=>true,
                        'otp_id'=>$savedOTP->id,
                        'success' => true,
                        'status' => 200,
                    ];
                    return response()->json($response, 200);
                }catch (Exception $e){
                    echo "Error: " . $e->getMessage();
                }

            }else{ // send with msg91
                $payCreds = DB::table('settings')
                ->select('*')->first();
                if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }
                $credsData = json_decode($payCreds->sms_creds);
                if(is_null($credsData) || is_null($credsData->msg) || is_null($credsData->msg->key)){
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }
                $clientId = $credsData->msg->key;
                $smsSender = $credsData->msg->sender;
                $otp = random_int(100000, 999999);
                $client = new \GuzzleHttp\Client();
                $to = $request->country_code.$request->mobile;
                $res = $client->get('http://api.msg91.com/api/sendotp.php?authkey='.$clientId.'&message=Your Verification code is : '.$otp.'&mobile='.$to.'&sender='.$smsSender.'&otp='.$otp);
                $data = json_decode($res->getBody()->getContents());
                $savedOTP = Otp::create([
                    'otp'=>$otp,
                    'email'=>$to,
                    'status'=>0,
                ]);
                $response = [
                    'data'=>true,
                    'otp_id'=>$savedOTP->id,
                    'success' => true,
                    'status' => 200,
                ];
                return response()->json($response, 200);
            }

        }
        return response()->json(['error' => 'Phone exist.'], 500);

    }

    public function verifyPhoneDriver(OtpTokenRequest $request){
        // $validator = Validator::make($request->all(), [
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

        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $data= Drivers::where($matchThese)->first();
        if (is_null($data)) {
            return response()->json(['error' => 'User not found.'], 500);
        }

        $settings = Settings::take(1)->first();
        if($settings->sms_name =='0'){ // send with twillo
            $payCreds = DB::table('settings')
            ->select('*')->first();
            if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->sms_creds);
            if(is_null($credsData) || is_null($credsData->twilloCreds) || is_null($credsData->twilloCreds->sid)){
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }

            $id = $credsData->twilloCreds->sid;
            $token = $credsData->twilloCreds->token;
            $url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
            $from = $credsData->twilloCreds->from;
            $to = $request->country_code.$request->mobile; // twilio trial verified number
            try{
                $otp = random_int(100000, 999999);
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', $url, [
                    'headers' =>
                    [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/x-www-form-urlencoded',
                    ],
                    'form_params' => [
                    'Body' => 'Your Verification code is : '.$otp, //set message body
                    'To' => $to,
                    'From' => $from //we get this number from twilio
                    ],
                    'auth' => [$id, $token, 'basic']
                    ]
                );
                $savedOTP = Otp::create([
                    'otp'=>$otp,
                    'email'=>$to,
                    'status'=>0,
                ]);
                $response = [
                    'data'=>true,
                    'otp_id'=>$savedOTP->id,
                    'success' => true,
                    'status' => 200,
                ];
                return response()->json($response, 200);
            }catch (Exception $e){
                echo "Error: " . $e->getMessage();
            }

        }else{ // send with msg91
            $payCreds = DB::table('settings')
            ->select('*')->first();
            if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->sms_creds);
            if(is_null($credsData) || is_null($credsData->msg) || is_null($credsData->msg->key)){
                $response = [
                    'success' => false,
                    'message' => 'sms gateway issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $clientId = $credsData->msg->key;
            $smsSender = $credsData->msg->sender;
            $otp = random_int(100000, 999999);
            $client = new \GuzzleHttp\Client();
            $to = $request->country_code.$request->mobile;
            $res = $client->get('http://api.msg91.com/api/sendotp.php?authkey='.$clientId.'&message=Your Verification code is : '.$otp.'&mobile='.$to.'&sender='.$smsSender.'&otp='.$otp);
            $data = json_decode($res->getBody()->getContents());
            $savedOTP = Otp::create([
                'otp'=>$otp,
                'email'=>$to,
                'status'=>0,
            ]);
            $response = [
                'data'=>true,
                'otp_id'=>$savedOTP->id,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
    }

    public function verifyPhoneDriverNew(OtpTokenRequest $request){
        // $validator = Validator::make($request->all(), [
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
        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $data= Drivers::where($matchThese)->first();
        if (is_null($data)) {
            $settings = Settings::take(1)->first();
            if($settings->sms_name =='0'){ // send with twillo
                $payCreds = DB::table('settings')
                ->select('*')->first();
                if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }
                $credsData = json_decode($payCreds->sms_creds);
                if(is_null($credsData) || is_null($credsData->twilloCreds) || is_null($credsData->twilloCreds->sid)){
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }

                $id = $credsData->twilloCreds->sid;
                $token = $credsData->twilloCreds->token;
                $url = "https://api.twilio.com/2010-04-01/Accounts/$id/Messages.json";
                $from = $credsData->twilloCreds->from;
                $to = $request->country_code.$request->mobile; // twilio trial verified number
                try{
                    $otp = random_int(100000, 999999);
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('POST', $url, [
                        'headers' =>
                        [
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                        'form_params' => [
                        'Body' => 'Your Verification code is : '.$otp, //set message body
                        'To' => $to,
                        'From' => $from //we get this number from twilio
                        ],
                        'auth' => [$id, $token, 'basic']
                        ]
                    );
                    $savedOTP = Otp::create([
                        'otp'=>$otp,
                        'email'=>$to,
                        'status'=>0,
                    ]);
                    $response = [
                        'data'=>true,
                        'otp_id'=>$savedOTP->id,
                        'success' => true,
                        'status' => 200,
                    ];
                    return response()->json($response, 200);
                }catch (Exception $e){
                    echo "Error: " . $e->getMessage();
                }

            }else{ // send with msg91
                $payCreds = DB::table('settings')
                ->select('*')->first();
                if (is_null($payCreds) || is_null($payCreds->sms_creds)) {
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }
                $credsData = json_decode($payCreds->sms_creds);
                if(is_null($credsData) || is_null($credsData->msg) || is_null($credsData->msg->key)){
                    $response = [
                        'success' => false,
                        'message' => 'sms gateway issue please contact administrator',
                        'status' => 404
                    ];
                    return response()->json($response, 404);
                }
                $clientId = $credsData->msg->key;
                $smsSender = $credsData->msg->sender;
                $otp = random_int(100000, 999999);
                $client = new \GuzzleHttp\Client();
                $to = $request->country_code.$request->mobile;
                $res = $client->get('http://api.msg91.com/api/sendotp.php?authkey='.$clientId.'&message=Your Verification code is : '.$otp.'&mobile='.$to.'&sender='.$smsSender.'&otp='.$otp);
                $data = json_decode($res->getBody()->getContents());
                $savedOTP = Otp::create([
                    'otp'=>$otp,
                    'email'=>$to,
                    'status'=>0,
                ]);
                $response = [
                    'data'=>true,
                    'otp_id'=>$savedOTP->id,
                    'success' => true,
                    'status' => 200,
                ];
                return response()->json($response, 200);
            }

        }
        return response()->json(['error' => 'Phone exist.'], 500);

    }

    public function importData(CSVfileRequest $request){
        $file = $request->file("csv_file");
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);
        foreach ($rows as $row) {
            if (isset($row[0])) {
                if ($row[0] != "") {

                    if(count($header) == count($row)){
                        $row = array_combine($header, $row);
                        $insertInfo =  array(
                            'id' => $row['id'],
                            'otp' => $row['otp'],
                            'email' => $row['email'],
                            'status' => $row['status'],
                        );
                        $checkLead  =  Otp::where("id", "=", $row["id"])->first();
                        if (!is_null($checkLead)) {
                            DB::table('otp')->where("id", "=", $row["id"])->update($insertInfo);
                        }
                        else {
                            DB::table('otp')->insert($insertInfo);
                        }
                    }
                }
            }
        }
        $response = [
            'data'=>'Done',
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
}
