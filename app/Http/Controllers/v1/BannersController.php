<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerByIdRequest;
use App\Http\Requests\BannerRequest;
use App\Http\Requests\CSVfileRequest;
use Illuminate\Http\Request;
use App\Models\Banners;
use App\Models\Cities;
use App\Models\Category;
use App\Models\Products;
use Carbon\Carbon;
use Validator;
use DB;
class BannersController extends Controller
{
    public function save(BannerRequest $request){
        // `$validator = Validator::make($request->all(), [
        //     'city_id' => 'required',
        //     'cover' => 'required',
        //     'position' => 'required',
        //     'link' => 'required',
        //     'type' => 'required',
        //     'message' => 'required',
        //     'from' => 'required',
        //     'to' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json`($response, 404);
        // }

        $data = Banners::create($request->all());
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

    public function getById(BannerByIdRequest $request){
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

        $data = Banners::find($request->id);

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

    public function update(BannerByIdRequest $request){
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
        $data = Banners::find($request->id)->update($request->all());

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

    public function delete(BannerByIdRequest $request){
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
        $data = Banners::find($request->id);
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

    public function getAll(){
        $data = Banners::all();
        foreach($data as $loop){
            if($loop->city_id){
                $city = Cities::select('name')->where('id',$loop->city_id)->first();
                $loop->city_name = $city;
            }else{
                $loop->city_name = null;
            }
            if($loop->type == 0 || $loop->type == '0'){
                $category = Category::select('name')->where('id',$loop->link)->first();
                $loop->cate_name = $category;
            }

            if($loop->type == 1 || $loop->type == '1'){
                $products = Products::select('name')->where('id',$loop->link)->first();
                $loop->product_name = $products;
            }

        }

        $response = [
            'data'=>$data,
            'cities'=>Cities::all(),
            'products'=>Products::where('status',1)->get(),
            'categories'=>Category::where('status',1)->get(),
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function userBanners(BannerByIdRequest $request){
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
        $today = Carbon::now();
        $data = Banners::where(['status'=>1,'city_id'=>$request->id])->whereDate('from','<=', $today)->whereDate('to','>=', $today)->get();
        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function importData(CSVfileRequest $request){
        // $request->validate([
        //     "csv_file" => "required",
        // ]);
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
                            'cover' => $row['cover'],
                            'position' => $row['position'],
                            'link' => $row['link'],
                            'type' => $row['type'],
                            'message' => $row['message'],
                            'status' => $row['status'],
                        );
                        $banner  =  Banners::where("id", $row["id"])->first();
                        if (!is_null($banner)) {
                            // $banner->
                            DB::table('banners')->where("id", "=", $row["id"])->update($insertInfo);
                        }
                        else {
                            // Banners::
                            DB::table('banners')->insert($insertInfo);
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
