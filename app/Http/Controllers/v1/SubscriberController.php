<?php

namespace App\Http\Controllers\v1;

use DB;
use Validator;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVfileRequest;
use App\Http\Requests\SubsribersRequest;
use App\Http\Requests\SubsribersByIdRequest;

class SubscriberController extends Controller
{
    public function save(SubsribersRequest $request)
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

        $data = Subscriber::create($request->all());
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

    public function getById(SubsribersByIdRequest $request)
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

        $data = Subscriber::find($request->id);

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

    public function update(SubsribersByIdRequest $request)
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
        $data = Subscriber::find($request->id)->update($request->all());

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

    public function delete(SubsribersByIdRequest $request)
    {
    //  $validator = Validator::make($request->all(), [
    //         'id' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         $response = [
    //             'success' => false,
    //             'message' => 'Validation Error.', $validator->errors(),
    //             'status'=> 500
    //         ];
    //         return response()->json($response, 404);
    //     }
        $data = Subscriber::find($request->id);
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
        $data = Subscriber::all();
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
                            'email' => $row['email'],
                            'timestamp' => $row['timestamp'],
                        );
                        $checkLead  =  Subscriber::where("id", "=", $row["id"])->first();
                        if (!is_null($checkLead)) {
                            DB::table('subscriber')->where("id", "=", $row["id"])->update($insertInfo);
                        }
                        else {
                            DB::table('subscriber')->insert($insertInfo);
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
