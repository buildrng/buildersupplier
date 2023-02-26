<?php

namespace App\Http\Controllers\v1;

use DB;
use Stripe;
use Exception;
use Validator;
use App\Models\Orders;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentsRequest;
use App\Http\Requests\PaymentsByIdRequest;
use App\Http\Requests\PaymentsCustomerRequest;
use App\Http\Requests\PaymentsFlutterwaveRefundRequest;
use App\Http\Requests\PaymentsFlutterwaveRequest;
use App\Http\Requests\PaymentsPaypalRefundRequest;
use App\Http\Requests\PaymentsPaypalRequest;
use App\Http\Requests\PaymentsPaystackRefundRequest;
use App\Http\Requests\PaymentsPaystackRequest;
use App\Models\Bankaccounts;

class PaymentsController extends Controller
{
    public function save(PaymentsRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'env' => 'required',
        //     'creds' => 'required',
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

        $data = Payments::create($request->all());
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

    public function getPaymentInfo(PaymentsByIdRequest $request)
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
        $data = DB::table('payments')
        ->select('*')->where('id',$request->id)->first();
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

    public function getById(PaymentsByIdRequest $request)
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

        $data = Payments::find($request->id);

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

    public function update(PaymentsByIdRequest $request)
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
        $data = Payments::find($request->id)->update($request->all());

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

    public function delete(PaymentsByIdRequest $request)
    {
        $data = Payments::find($request->id);
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

    public function getAll()
    {
        $data = Payments::all();
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

    public function getPayments()
    {
        // $data = Payments::where('status',1)->get();
        $data = Bankaccounts::where('status',1)->get();
        
        if ($data) {
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

    public function getPayPalKey()
    {
        $payCreds = DB::table('payments')
        ->select('*')->where('id',3)->first();
        if (is_null($payCreds) || is_null($payCreds->creds)) {
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $credsData = json_decode($payCreds->creds);
        if(is_null($credsData) || is_null($credsData->client_id)){
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $clientId = $credsData->client_id;
        // $secret = $credsData->client_secret;
        $response = [
            'data'=>$clientId,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getFlutterwaveKey()
    {
        $payCreds = DB::table('payments')
        ->select('*')->where('id',8)->first();
        if (is_null($payCreds) || is_null($payCreds->creds)) {
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $credsData = json_decode($payCreds->creds);
        if(is_null($credsData) || is_null($credsData->key)){
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $clientId = $credsData->key;
        // $secret = $credsData->secret;
        $response = [
            'data'=>$clientId,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getPaystackKey()
    {
        $payCreds = DB::table('payments')
        ->select('*')->where('id',7)->first();
        if (is_null($payCreds) || is_null($payCreds->creds)) {
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $credsData = json_decode($payCreds->creds);
        if(is_null($credsData) || is_null($credsData->sk)){
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $pk = $credsData->pk;
        $sk = $credsData->sk;
        $response = [
            'data'=>$pk,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function createCustomer(PaymentsCustomerRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'email' => 'required',
            //     'source' => 'required',
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }
            $payCreds = DB::table('payments')
            ->select('*')->where('id',2)->first();
            if (is_null($payCreds) || is_null($payCreds->creds)) {
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->creds);
            if(is_null($credsData) || is_null($credsData->secret)){
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            // $stripe = new \Stripe\StripeClient(
            //     $credsData->secret
            // );
            // $data = $stripe->customers->create([
            //     'description' => 'Foodies-Dining Customer',
            //     'email'=>$request->email,
            //     'source'=>$request->source
            //   ]);
            // $response = [
            //     'success' => $data,
            //     'message' => 'success',
            //     'status' => 200
            // ];
            // return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function success_payments()
    {
        return view('payments/success');;
    }

    public function failed_payments()
    {
        return view('payments/failed');
    }

    public function payPalPay(PaymentsPaypalRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'amount' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $payCreds = DB::table('payments')
        ->select('*')->where('id',3)->first();
        if (is_null($payCreds) || is_null($payCreds->creds)) {
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $credsData = json_decode($payCreds->creds);
        if(is_null($credsData) || is_null($credsData->client_id)){
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $clientId = $credsData->client_id;
        $url = url('/api/v1/success_payments');
        return view('payments/paypal',['amount'=>$request->amount,'url'=>$url,'client_id'=>$clientId]);
    }

    public function payPalRefund(PaymentsPaypalRefundRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'ref' => 'required',
            //     'amount'=>'required'
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }
            $uri = 'https://api.sandbox.paypal.com/v1/oauth2/token';
            $payCreds = DB::table('payments')
            ->select('*')->where('id',3)->first();
            if (is_null($payCreds) || is_null($payCreds->creds)) {
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->creds);
            if(is_null($credsData) || is_null($credsData->client_id)){
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $clientId = $credsData->client_id;
            $secret = $credsData->client_secret;

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $uri, [
                    'headers' =>
                        [
                            'Accept' => 'application/json',
                            'Accept-Language' => 'en_US',
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                    'body' => 'grant_type=client_credentials',

                    'auth' => [$clientId, $secret, 'basic']
                ]
            );

            $data = json_decode($response->getBody(), true);

            $access_token = $data['access_token'];
            $paymentResponse = $client->request('POST', 'https://api-m.sandbox.paypal.com/v1/payments/sale/'.$request->ref.'/refund', [
                'headers' => array(
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer $access_token",
                ),
                // 'body' => $jsonBody
            ]);


            $paymentExecutionBody = json_decode($paymentResponse->getBody()->getContents());
            // return $paymentExecutionBody;
            $response = [
                'success' => $paymentExecutionBody,
                'message' => 'success',
                'status' => 200
            ];
            return $response;
        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function flutterwavePay(PaymentsFlutterwaveRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'amount' => 'required',
        //     'name'=>'required',
        //     'logo'=>'required',
        //     'email'=>'required',
        //     'app_name'=>'required',
        //     'code'=>'required',
        //     'phone'=>'required'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $payCreds = DB::table('payments')
        ->select('*')->where('id',8)->first();

        if (is_null($payCreds) || is_null($payCreds->creds)) {
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $credsData = json_decode($payCreds->creds);
        if(is_null($credsData) || is_null($credsData->key)){
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $clientId = $credsData->key;
        $successURL = url('/api/v1/success_payments');
        $errorCallBack = url('/api/v1/failed_payments');
        return view('payments/flutterwave',
        ['key'=>$clientId,'amount'=>$request->amount,'code'=>$request->code,'callback'=>$successURL,'errorCallBack'=>$errorCallBack,'name'=>$request->name,'logo'=>$request->logo,'phone'=>$request->phone,'email'=>$request->email,'app_name'=>$request->app_name]);
    }

    public function paystackPay(PaymentsPaystackRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'amount' => 'required',
        //     'first_name'=>'required',
        //     'last_name'=>'required',
        //     'email'=>'required',
        //     'ref'=>'required'
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $payCreds = DB::table('payments')
        ->select('*')->where('id',7)->first();
        if (is_null($payCreds) || is_null($payCreds->creds)) {
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $credsData = json_decode($payCreds->creds);
        if(is_null($credsData) || is_null($credsData->sk)){
            $response = [
                'success' => false,
                'message' => 'Payment issue please contact administrator',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $pk = $credsData->pk;
        $sk = $credsData->sk;
        $successURL = url('/api/v1/success_payments');
        $errorCallBack = url('/api/v1/failed_payments');
        return view('payments/paystack',
        ['key'=>$pk,'ref'=>$request->ref,'amount'=>$request->amount,'sucessCallBack'=>$successURL,'errorCallBack'=>$errorCallBack,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'email'=>$request->email]);
    }

    public function refundFlutterwave(PaymentsFlutterwaveRefundRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'ref' => 'required',
            //     'amount'=>'required'
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }
            $payCreds = DB::table('payments')
            ->select('*')->where('id',8)->first();
            if (is_null($payCreds) || is_null($payCreds->creds)) {
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->creds);
            if(is_null($credsData) || is_null($credsData->key)){
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $clientId = $credsData->key;
            $secret = $credsData->secret;
            $client = new \GuzzleHttp\Client();
            $headers = [
                'Authorization' => 'Bearer ' . $secret,
                'Accept'        => 'application/json',
            ];
            $res = $client->post('https://api.flutterwave.com/v3/transactions/'.$request->ref.'refund',[
                'headers'=>$headers
            ]);
            $data = json_decode($res->getBody()->getContents());

            $response = [
                'success' => $data,
                'message' => 'success',
                'status' => 200
            ];
            return $response;
        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }
    }

    public function refundPayStack(PaymentsPaystackRefundRequest $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'id' => 'required'
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'success' => false,
            //         'message' => 'Validation Error.', $validator->errors(),
            //         'status'=> 500
            //     ];
            //     return response()->json($response, 404);
            // }
            $payCreds = DB::table('payments')
            ->select('*')->where('id',7)->first();
            if (is_null($payCreds) || is_null($payCreds->creds)) {
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $credsData = json_decode($payCreds->creds);
            if(is_null($credsData) || is_null($credsData->sk)){
                $response = [
                    'success' => false,
                    'message' => 'Payment issue please contact administrator',
                    'status' => 404
                ];
                return response()->json($response, 404);
            }
            $pk = $credsData->pk;
            $sk = $credsData->sk;
            $client = new \GuzzleHttp\Client();
            $bodyRAW = array();
            $bodyRAW["transaction"] = $request->id;
            $response = $client->request('POST', 'https://api.paystack.co/refund', [
                    'headers' => array(
                        'Content-Type' => 'application/json',
                        'Authorization' => "Bearer ".$sk,
                    ),
                    'body' => json_encode($bodyRAW),
                ]
            );

            $data = json_decode($response->getBody(), true);
            $response = [
                'success' => $data,
                'message' => 'success',
                'status' => 200
            ];
            return $response;
        } catch (Exception $e) {
            return response()->json($e->getMessage(),200);
        }

    }

}
