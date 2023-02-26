<?php

namespace App\Http\Controllers\v1;

use DB;
use Validator;
use App\Models\Stores;
use App\Models\Ratings;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVfileRequest;
use App\Http\Requests\RatingsRequest;
use App\Http\Requests\RatingsByIdRequest;
use App\Http\Requests\RatingForStoreRequest;
use App\Http\Requests\RatingForDriverRequest;
use App\Http\Requests\RatingForProductRequest;

class RatingsController extends Controller
{
    public function save(RatingsRequest $request)
    {
    //     $validator = Validator::make($request->all(), [
    //         'uid' => 'required',
    //         'pid' => 'required',
    //         'did' => 'required',
    //         'sid' => 'required',
    //         'rate' => 'required',
    //         'msg' => 'required',
    //         'way' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         $response = [
    //             'success' => false,
    //             'message' => 'Validation Error.', $validator->errors(),
    //             'status'=> 500
    //         ];
    //         return response()->json($response, 404);
    //     }

        $data = Ratings::create($request->all());
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

    public function getById(RatingsByIdRequest $request)
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

        $data = Ratings::find($request->id);

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

    public function update(RatingsByIdRequest $request)
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
        $data = Ratings::find($request->id)->update($request->all());

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

    public function delete(RatingsByIdRequest $request)
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
        $data = Ratings::find($request->id);
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
        $data = Ratings::all();
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

    public function saveStoreRatings(RatingForStoreRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'uid' => 'required',
        //     'pid' => 'required',
        //     'did' => 'required',
        //     'sid' => 'required',
        //     'rate' => 'required',
        //     'msg' => 'required',
        //     'way' => 'required',
        //     'total_rating' => 'required',
        //     'rating' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Ratings::create($request->all());
        if (is_null($data)) {
            $response = [
            'data'=>$data,
            'message' => 'error',
            'status' => 500,
        ];
        return response()->json($response, 200);
        }
        $updates = Stores::where('uid',$request->sid)->update($request->only('total_rating','rating'));
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function saveDriversRatings(RatingForDriverRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'uid' => 'required',
        //     'pid' => 'required',
        //     'did' => 'required',
        //     'sid' => 'required',
        //     'rate' => 'required',
        //     'msg' => 'required',
        //     'way' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Ratings::create($request->all());
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

    public function saveProductRatings(RatingForProductRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'uid' => 'required',
        //     'pid' => 'required',
        //     'did' => 'required',
        //     'sid' => 'required',
        //     'rate' => 'required',
        //     'msg' => 'required',
        //     'way' => 'required',
        //     'total_rating' => 'required',
        //     'rating' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Ratings::create($request->all());
        if (is_null($data)) {
            $response = [
            'data'=>$data,
            'message' => 'error',
            'status' => 500,
        ];
        return response()->json($response, 200);
        }
        $updates = Products::where('id',$request->sid)->update($request->only('total_rating','rating'));
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getByStoreId(RatingsByIdRequest $request)
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
        $data = Ratings::where('id',$request->id)->get();
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);

    }

    public function getProductsRatings(RatingsByIdRequest $request)
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
        $data  = DB::table('rating')
                    ->where('pid',$request->id)
                    ->select('rating.id as id','rating.rate as rate','rating.msg as msg','rating.way as way','users.first_name as first_name','users.last_name as last_name','users.cover as cover')
                    ->join('users','rating.uid','users.id')
                    ->get();

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getWithStoreId(RatingsByIdRequest $request)
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
        $data  = DB::table('rating')
                    ->where('sid',$request->id)
                    ->select('rating.id as id','rating.rate as rate','rating.timestamp as timestamp','rating.msg as msg','rating.way as way','users.first_name as first_name','users.last_name as last_name','users.cover as cover')
                    ->join('users','rating.uid','users.id')
                    ->get();

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getWithDriverId(RatingsByIdRequest $request)
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
        $data  = DB::table('rating')
                    ->where('did',$request->id)
                    ->select('rating.id as id','rating.rate as rate','rating.msg as msg','rating.way as way','users.first_name as first_name','users.last_name as last_name','users.cover as cover')
                    ->join('users','rating.uid','users.id')
                    ->get();

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getByDriverId(RatingsByIdRequest $request)
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
        $data = Ratings::where('did',$request->id)->get();
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getByProductId(RatingsByIdRequest $request)
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
        $data = Ratings::where('pid',$request->id)->get();
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
    public function importData(CSVfileRequest $request)
    {
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
                            'uid' => $row['uid'],
                            'pid' => $row['pid'],
                            'did' => $row['did'],
                            'sid' => $row['sid'],
                            'rate' => $row['rate'],
                            'msg' => $row['msg'],
                            'way' => $row['way'],
                            'status' => $row['status'],
                            'timestamp' => $row['timestamp'],
                        );
                        $checkLead  =  Ratings::where("id", "=", $row["id"])->first();
                        if (!is_null($checkLead)) {
                            DB::table('rating')->where("id", "=", $row["id"])->update($insertInfo);
                        }
                        else {
                            DB::table('rating')->insert($insertInfo);
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
