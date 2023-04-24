<?php

namespace App\Http\Controllers\v1;

use DB;
use Validator;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVfileRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoriesRequest;
use App\Http\Requests\CategoryByIdRequest;

class CategoryController extends Controller
{
    public function save(CategoryRequest $request){
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'cover' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Category::create($request->all());
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

    public function getById(CategoryByIdRequest $request){
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

        $data = Category::find($request->id);

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

    public function update(CategoryByIdRequest $request){
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
        $data = Category::find($request->id)->update($request->all());

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

    public function delete(CategoryByIdRequest $request){
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
        $data = Category::find($request->id);
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
        $data = Category::all();
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

    public function getActiveItem(Request $request){
        $data = Category::where('status',1)->get();

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
                            'name' => $row['name'],
                            'cover' => $row['cover'],
                            'status' => $row['status'],
                        );
                        $checkLead  =  Category::where("id", "=", $row["id"])->first();
                        if (!is_null($checkLead)) {
                            DB::table('category')->where("id", "=", $row["id"])->update($insertInfo);
                        }
                        else {
                            DB::table('category')->insert($insertInfo);
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

    public function getHome(CategoriesRequest $request, string $sector = 'personal'){
        $category = Category::where('status',1)->where('sector', $sector)->limit(9)->get();
        $subcategory = SubCategory::where('status',1)->where('sector', $sector)->limit(9)->get();
        // foreach($category as $loop){
        //     $loop->subCates = SubCategory::where(['status'=>1,'cate_id'=>$loop->id])->get();
        // }
        $data = [
            'category' => $category,
            'sub-categories' => $subcategory,
        ];

        $response = [
            'data'=>$data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
}
