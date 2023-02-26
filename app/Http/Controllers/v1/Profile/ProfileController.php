<?php

namespace App\Http\Controllers\v1\Profile;

use DB;
use Artisan;
use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\Otp;
use App\Models\User;
use App\Models\Stores;
use App\Models\Drivers;
use App\Models\General;
use App\Models\Settings;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\User as UserResource;
use App\Http\Requests\Profile\ProfileByIdRequest;
use App\Http\Requests\Profile\ProfileImageRequest;
use App\Http\Requests\Profile\ProfilePhoneRequest;
use App\Http\Requests\Profile\ProfileNotifyRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Http\Requests\Profile\ProfileByEmailRequest;
use App\Http\Requests\profile\SendVerificationOnMail;
use App\Http\Requests\Profile\ProfileStoreByIdRequest;
use App\Http\Requests\Profile\ProfileWalletByIdRequest;
use App\Http\Requests\Profile\ProfileNotifyStoreRequest;
use App\Http\Requests\Profile\ProfileUpdateNotifyRequest;
use App\Http\Requests\Profile\ProfileUpdatePasswordRequest;
use App\Http\Requests\Profile\ProfileUpdateUserPasswordPhoneRequest;
use App\Http\Requests\Profile\ProfileUpdateUserPasswordByEmailRequest;
use App\Http\Requests\Profile\ProfileUpdatePasswordFromFirebaseRequest;

class ProfileController extends Controller
{
     /**
     * Get Login User
     *
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        // Get data of Logged user
        $data = $user = Auth::user();

        // transform user data
        // $data = new UserResource($user);

        return response()->json(compact('data'));

    }

     /**
     * Update Profile
     *
     *
     * @param UpdateProfileRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileNameEmail(ProfileUpdateRequest $request)
    {
        // Get data of Logged user
        $data = $user = Auth::user();

        // Update User
        $user->update($request->only('name', 'email'));

        // transform user datax
        // $data = new UserResource($user);

        return response()->json(compact('data'));

    }

     /**
     * Update Profile
     *
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updatePassword(ProfileUpdatePasswordRequest $request)
    {
        // Get Request User
        $data = $user = $request->user();

        // Validate user Password and Request password
        if (!Hash::check($request->current_password, $user->password)) {
            // Validation failed return an error messsage
            return response()->json(['error' => 'Invalid current password'], 422);

        }

        // Update User password
        $user->update([
            'password' =>  Hash::make($request->new_password),
        ]);

        // transform user data
        // $data = new UserResource($user);

        return response()->json(compact('data'));
    }

    public function get_admin()
    {

        $data = User::where('type','=','admin')->first();

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
    public function get_admin_account()
    {

        $data = User::where('type','=','admin')->first();

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 200);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getAdmins()
    {
        $data = User::where('type',0)->get();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
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

    public function getProfileById(ProfileByIdRequest $request)
    {
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

        $data = User::where('id',$request->id)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
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

    public function uploadImage(ProfileImageRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 505);
        // }
        // Artisan::call('storage:link', []);
        $uploadFolder = 'images';
        $image = $request->file('image');
        $image_uploaded_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = array(
            "image_name" => basename($image_uploaded_path),
            "mime" => $image->getClientMimeType()
        );
        $response = [
            'data'=>$uploadedImageResponse,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateProfile(ProfileByIdRequest $request)
    {
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
        $data = User::find($request->id)->update($request->all());

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

    public function getById(ProfileByIdRequest $request)
    {
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

        $data = User::find($request->id);

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
            'fav'=>Favourite::where('uid',$request->id)->first(),
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getStoreFromId(ProfileStoreByIdRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'profile_store_id' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = User::find($request->id);
        // $store =

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $store = Stores::where('uid',$request->profile_store_id)->first();
        $response = [
            'data'=>$data,
            'store'=>$store,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function emailExist(ProfileByEmailRequest $request)
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

        $data = User::where('email',$request->email)->first();

        if (is_null($data)) {
            $response = [
                'data' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 200);
        }

        $mail = $request->email;
        $username = $request->email;
        $subject = $request->subject;
        $otp = random_int(100000, 999999);
        $generalInfo = General::take(1)->first();
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

    public function updateUserPasswordWithEmail(ProfileUpdateUserPasswordByEmailRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'password' => 'required',
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

        $match =  ['email'=>$request->email,'id'=>$request->id];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $updates = User::where('email',$request->email)->first();
        $updates->update(['password'=>Hash::make($request->password)]);

        if (is_null($updates)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateUserPasswordWithEmailDriver(ProfileUpdateUserPasswordByEmailRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'password' => 'required',
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

        $match =  ['email'=>$request->email,'id'=>$request->id];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $updates = Drivers::where('email',$request->email)->first();
        $updates->update(['password'=>Hash::make($request->password)]);

        if (is_null($updates)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateUserPasswordWithPhone(ProfileUpdateUserPasswordPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id' => 'required',
        //     'country_code' => 'required',
        //     'mobile' => 'required',
        //     'password' => 'required',
        //     'key'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $match =  ['email'=>$request->key,'id'=>$request->id];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $updates = User::where($matchThese)->first();
        $updates->update(['password'=>Hash::make($request->password)]);

        if (is_null($updates)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateUserPasswordWithPhoneDriver(ProfileUpdateUserPasswordPhoneRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'country_code' => 'required',
        //     'mobile' => 'required',
        //     'password' => 'required',
        //     'key'=>'required',
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

        $match =  ['email'=>$request->key,'id'=>$request->id];
        $data = Otp::where($match)->first();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $matchThese = ['country_code' => $request->country_code, 'mobile' => $request->mobile];
        $updates = Drivers::where($matchThese)->first();
        $updates->update(['password'=>Hash::make($request->password)]);

        if (is_null($updates)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updatePasswordFromFirebase(ProfileUpdatePasswordFromFirebaseRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'country_code' => 'required',
        //     'mobile' => 'required',
        //     'password' => 'required',
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
        $updates = User::where($matchThese)->first();
        $updates->update(['password'=>Hash::make($request->password)]);

        if (is_null($updates)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updatePasswordFromFirebaseDriver(ProfileUpdatePasswordFromFirebaseRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'country_code' => 'required',
        //     'mobile' => 'required',
        //     'password' => 'required',
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
        $updates = Drivers::where($matchThese)->first();
        $updates->update(['password'=>Hash::make($request->password)]);

        if (is_null($updates)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data'=>true,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function sendNoficationGlobal(ProfileUpdateNotifyRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'title' => 'required',
            //     'message' => 'required',
            //     'cover'  => 'required'
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }

            $data = DB::table('settings')
            ->select('*')->first();
            $allIds = DB::table('fcm')->select('fcm_token')->get();
            $fcm_ids = array();
            foreach($allIds as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }

            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $header = array();
            $header[] = 'Content-type: application/json';
            $header[] = 'Authorization: key=' . $data->fcm_token;

            $payload = [
                'registration_ids' => $fcm_ids,
                'priority'=>'high',
                'notification' => [
                  'title' => $request->title,
                  'body' => $request->message,
                  'image'=>$request->cover,
                  "sound" => "wave.wav",
                  "channelId"=>"fcm_default_channel"
                ],
                'android'=>[
                    'notification'=>[
                        "sound" => "wave.wav",
                        "defaultSound"=>true,
                        "channelId"=>"fcm_default_channel"
                    ]
                ]
              ];

            $crl = curl_init();
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_POST,true);
                curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

            $rest = curl_exec($crl);
            if ($rest === false) {
                return curl_error($crl);
            }
            curl_close($crl);
            // return $rest;
            $response = [
                'data'=>$rest,
                'ids',$fcm_ids,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function sendToStore(ProfileNotifyStoreRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'id'  => 'required',
            //     'title' => 'required',
            //     'message' => 'required'
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }

            $data = DB::table('settings')
            ->select('*')->first();
            $ids = explode(',',$request->id);
            $allIds = DB::table('users')->select('fcm_token')->WhereIn('id',$ids)->get();
            $fcm_ids = array();
            foreach($allIds as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }

            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $header = array();
            $header[] = 'Content-type: application/json';
            $header[] = 'Authorization: key=' . $data->fcm_token;

            $payload = [
                'registration_ids' => $fcm_ids,
                'priority'=>'high',
                'notification' => [
                  'title' => $request->title,
                  'body' => $request->message,
                  'image'=>$request->cover,
                  "sound" => "wave.wav",
                  "channelId"=>"fcm_default_channel"
                ],
                'android'=>[
                    'notification'=>[
                        "sound" => "wave.wav",
                        "defaultSound"=>true,
                        "channelId"=>"fcm_default_channel"
                    ]
                ]
              ];

            $crl = curl_init();
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_POST,true);
                curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

            $rest = curl_exec($crl);
            if ($rest === false) {
                return curl_error($crl);
            }
            curl_close($crl);
            // return $rest;
            $response = [
                'data'=>$rest,
                'ids',$fcm_ids,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function sendToAllUsers(ProfileNotifyRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'title' => 'required',
            //     'message' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }

            $data = DB::table('settings')
            ->select('*')->first();
            $ids = explode(',',$request->id);
            $allIds = DB::table('users')->select('fcm_token')->get();
            $allDrivers = DB::table('drivers')->select('fcm_token')->get();
            $fcm_ids = array();
            foreach($allIds as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }
            foreach($allDrivers as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }

            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $regIdChunk=array_chunk($fcm_ids,1000);
            foreach($regIdChunk as $RegId){
                // $chunkSent = send_notification($RegId, $message);
                $header = array();
                $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: key=' . $data->fcm_token;

                $payload = [
                    'registration_ids' => $RegId,
                    'priority'=>'high',
                    'notification' => [
                    'title' => $request->title,
                    'body' => $request->message,
                    'image'=>$request->cover,
                    "sound" => "wave.wav",
                    "channelId"=>"fcm_default_channel"
                    ],
                    'android'=>[
                        'notification'=>[
                            "sound" => "wave.wav",
                            "defaultSound"=>true,
                            "channelId"=>"fcm_default_channel"
                        ]
                    ]
                ];

                $crl = curl_init();
                curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($crl, CURLOPT_POST,true);
                    curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

                curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

                $rest = curl_exec($crl);
                if ($rest === false) {
                    return curl_error($crl);
                }
                curl_close($crl);
            }
            // return $rest;
            $response = [
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function sendToUsers(ProfileNotifyRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'title' => 'required',
            //     'message' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }

            $data = DB::table('settings')
            ->select('*')->first();
            $ids = explode(',',$request->id);
            $allIds = DB::table('users')->where('type','customer')->select('fcm_token')->get();
            $fcm_ids = array();
            foreach($allIds as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }


            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $regIdChunk=array_chunk($fcm_ids,1000);
            foreach($regIdChunk as $RegId){
                // $chunkSent = send_notification($RegId, $message);
                $header = array();
                $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: key=' . $data->fcm_token;

                $payload = [
                    'registration_ids' => $RegId,
                    'priority'=>'high',
                    'notification' => [
                    'title' => $request->title,
                    'body' => $request->message,
                    'image'=>$request->cover,
                    "sound" => "wave.wav",
                    "channelId"=>"fcm_default_channel"
                    ],
                    'android'=>[
                        'notification'=>[
                            "sound" => "wave.wav",
                            "defaultSound"=>true,
                            "channelId"=>"fcm_default_channel"
                        ]
                    ]
                ];

                $crl = curl_init();
                curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($crl, CURLOPT_POST,true);
                    curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

                curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

                $rest = curl_exec($crl);
                if ($rest === false) {
                    return curl_error($crl);
                }
                curl_close($crl);
           }
            // return $rest;
            $response = [
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function sendToStores(ProfileNotifyRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'title' => 'required',
            //     'message' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }

            $data = DB::table('settings')
            ->select('*')->first();
            $ids = explode(',',$request->id);
            $allIds = DB::table('users')->where('type','store')->select('fcm_token')->get();
            $fcm_ids = array();
            foreach($allIds as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }


            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $regIdChunk=array_chunk($fcm_ids,1000);
            foreach($regIdChunk as $RegId){
                // $chunkSent = send_notification($RegId, $message);
                $header = array();
                $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: key=' . $data->fcm_token;

                $payload = [
                    'registration_ids' => $RegId,
                    'priority'=>'high',
                    'notification' => [
                    'title' => $request->title,
                    'body' => $request->message,
                    'image'=>$request->cover,
                    "sound" => "wave.wav",
                    "channelId"=>"fcm_default_channel"
                    ],
                    'android'=>[
                        'notification'=>[
                            "sound" => "wave.wav",
                            "defaultSound"=>true,
                            "channelId"=>"fcm_default_channel"
                        ]
                    ]
                ];

                $crl = curl_init();
                curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($crl, CURLOPT_POST,true);
                    curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

                curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

                $rest = curl_exec($crl);
                if ($rest === false) {
                    return curl_error($crl);
                }
                curl_close($crl);
           }
            // return $rest;
            $response = [
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function sendToDrivers(ProfileNotifyRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'title' => 'required',
            //     'message' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }

            $data = DB::table('settings')
            ->select('*')->first();
            $ids = explode(',',$request->id);
            $allIds = DB::table('drivers')->select('fcm_token')->get();
            $fcm_ids = array();
            foreach($allIds as $i => $i_value) {
                if($i_value->fcm_token !='NA'){
                    array_push($fcm_ids,$i_value->fcm_token);
                }
            }


            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $regIdChunk=array_chunk($fcm_ids,1000);
            foreach($regIdChunk as $RegId){
                // $chunkSent = send_notification($RegId, $message);
                $header = array();
                $header[] = 'Content-type: application/json';
                $header[] = 'Authorization: key=' . $data->fcm_token;

                $payload = [
                    'registration_ids' => $RegId,
                    'priority'=>'high',
                    'notification' => [
                    'title' => $request->title,
                    'body' => $request->message,
                    'image'=>$request->cover,
                    "sound" => "wave.wav",
                    "channelId"=>"fcm_default_channel"
                    ],
                    'android'=>[
                        'notification'=>[
                            "sound" => "wave.wav",
                            "defaultSound"=>true,
                            "channelId"=>"fcm_default_channel"
                        ]
                    ]
                ];

                $crl = curl_init();
                curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
                curl_setopt($crl, CURLOPT_POST,true);
                    curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

                curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

                $rest = curl_exec($crl);
                if ($rest === false) {
                    return curl_error($crl);
                }
                curl_close($crl);
           }
            // return $rest;
            $response = [
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function sendNotification(ProfileNotifyStoreRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'title' => 'required',
            //     'message' => 'required',
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

            $data = DB::table('settings')
            ->select('*')->first();
            if (is_null($data)) {
                $response = [
                    'data' => false,
                    'message' => 'Data not found.',
                    'status' => 404
                ];
                return response()->json($response, 200);
            }
            $header = array();
            $header[] = 'Content-type: application/json';
            $header[] = 'Authorization: key=' . $data->fcm_token;

            $payload = [
                'to' => $request->id,
                'priority'=>'high',
                'notification' => [
                  'title' => $request->title,
                  'body' => $request->message,
                  "sound" => "wave.wav",
                  "channelId"=>"fcm_default_channel"
                ],
                'android'=>[
                    'notification'=>[
                        "sound" => "wave.wav",
                        "defaultSound"=>true,
                        "channelId"=>"fcm_default_channel"
                    ]
                ]
              ];

            $crl = curl_init();
            curl_setopt($crl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($crl, CURLOPT_POST,true);
                curl_setopt($crl, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($crl, CURLOPT_POSTFIELDS, json_encode( $payload ) );

            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true );

            $rest = curl_exec($crl);
            if ($rest === false) {
                return curl_error($crl);
            }
            curl_close($crl);
            return $rest;


        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function verifyPhoneSignup(ProfilePhoneRequest $request)
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

        $response = [
            'data' => false,
            'message' => 'email or mobile is already registered',
            'status' => 500
        ];
        return response()->json($response, 200);
    }

    public function sendVerificationOnMail(SendVerificationOnMail $request)
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
            $settings = Settings::take(1)->first();
            $generalInfo = General::take(1)->first();
            // $email = $request->email;
            // $request = $request;
            // $subject = $request->subject;
            $otp = random_int(100000, 999999);
            $savedOTP = Otp::create([
                'otp'=>$otp,
                'email'=>$request->email,
                'status'=>0,
            ]);
            $mailTo = Mail::send('emails/users/register',
                [
                    'app_name'      => 'Builder Supplier',
                    'otp'          => $savedOTP->otp,
                    'request'          => $request
                    ]
                , function($message) use($request){
                $message->to($request->email);
                $message->subject($request->greet.' '.$request->first_name.', '.$request->message_subject);
                $message->from(env('MAIL_FROM_ADDRESS', 'support@builder.tests'),'Builder Supplier');
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

        $response = [
            'data' => false,
            'message' => 'something went wrong',
            'status' => 500
        ];
        return response()->json($response, 200);
    }

    public function getMyWalletBalance(ProfileWalletByIdRequest $request)
    {
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
        $data = User::find($request->id);
        $data['balance'] = $data->balance;
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getMyWallet(ProfileWalletByIdRequest $request)
    {
        // $data = Auth::user();
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
        $data = User::find($request->id);
        $data['balance'] = $data->balance;

        $transactions = DB::table('transactions')
        ->select('amount','uuid','type','created_at','updated_at')
        ->where('payable_id',$request->id)
        ->get();
        $response = [
            'data'=>$data,
            'transactions'=>$transactions,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
}
