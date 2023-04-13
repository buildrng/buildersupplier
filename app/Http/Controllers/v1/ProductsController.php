<?php

namespace App\Http\Controllers\v1;

use DB;
use Validator;
use Carbon\Carbon;
use App\Models\Cities;
use App\Models\Stores;
use App\Models\Banners;
use App\Models\Category;
use App\Models\Products;
use App\Models\Settings;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVfileRequest;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\ProductsByIdRequest;
use App\Http\Requests\ProductsStoreRequest;
use App\Http\Requests\ProductsBySearchRequest;
use App\Http\Requests\ProductsByZipcodeRequest;
use App\Http\Requests\ProductsStoreCityRequest;
use App\Http\Requests\ProductsWitLimitsRequest;
use App\Http\Requests\ProductsByLocationRequest;
use App\Http\Requests\ProductsSearchByCityRequest;
use App\Http\Requests\ProductsBySubCategoryRequest;
use App\Http\Requests\ProductsCityWithLimitRequest;
use App\Http\Requests\ProductsStoreByZipcodeRequest;
use App\Http\Requests\ProductsStoreWitLimitsRequest;
use App\Http\Requests\ProductsLocationWithLimitRequest;
use App\Http\Requests\ProductsByZipcodeWithLimitsRequest;
use App\Http\Requests\ProductsCategoriesWithLimitRequest;

class ProductsController extends Controller
{
    public function save(ProductsRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'cover' => 'required',
        //     'name' => 'required',
        //     'images' => 'required',
        //     'original_price' => 'required',
        //     'sell_price' => 'required',
        //     'discount' => 'required',
        //     'kind' => 'required',
        //     'cate_id' => 'required',
        //     'sub_cate_id' => 'required',
        //     'in_home' => 'required',
        //     'is_single' => 'required',
        //     'have_gram' => 'required',
        //     'gram' => 'required',
        //     'have_kg' => 'required',
        //     'kg' => 'required',
        //     'have_pcs' => 'required',
        //     'pcs' => 'required',
        //     'have_liter' => 'required',
        //     'liter' => 'required',
        //     'have_ml' => 'required',
        //     'ml' => 'required',
        //     'type_of' => 'required',
        //     'in_offer' => 'required',
        //     'in_store' => 'required',
        //     'rating' => 'required',
        //     'total_rating' => 'required',
        //     'variations' => 'required',
        //     'size' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }

        $data = Products::create($request->all());
        if (is_null($data)) {
            $response = [
                'data' => $data,
                'message' => 'error',
                'status' => 500,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getById(ProductsByIdRequest $request)
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

        $data = Products::find($request->id);


        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $related = Products::where(['status' => 1, 'store_id' => $data->store_id, 'sub_cate_id' => $data->sub_cate_id])->get();
        $storeInfo = Stores::select('id', 'uid', 'name', 'status', 'zipcode', 'cid')->where('id', $data->store_id)->first();
        $response = [
            'data' => $data,
            'related' => $related,
            'store' => $storeInfo,
            'soldby' => $storeInfo,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function update(ProductsByIdRequest $request)
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
        $data = Products::find($request->id)->update($request->all());

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateStatus(ProductsByIdRequest $request)
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
        $data = Products::find($request->id)->update($request->only('status'));

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateOffers(ProductsByIdRequest $request)
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
        $data = Products::find($request->id)->update($request->only('in_offer'));

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function updateHome(ProductsByIdRequest $request)
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
        $data = Products::find($request->id)->update($request->only('in_home'));

        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function delete(ProductsByIdRequest $request)
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
        $data = Products::find($request->id);
        if ($data) {
            $data->delete();
            $response = [
                'data' => $data,
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
        $data = Products::all();
        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }

        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchStoreWithGeoLocation(ProductsByLocationRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'lat'=>'required',
        //     'lng' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        if (2 == 1) {
            $values = 3959; // miles
            $distanceType = 'miles';
        } else {
            $values = 6371; // km
            $distanceType = 'km';
        }
        $settings = DB::table('settings')->select('search_radius')->first();
        \DB::enableQueryLog();
        $stores = Stores::select(DB::raw('store.id as id,store.uid as uid,store.name as name,store.mobile as mobile,store.lat as lat,store.lng as lng,
        store.verified as verified,store.address as address,store.descriptions as descriptions,store.images as images,store.cover as cover,store.open_time as open_time,
        store.close_time as close_time,store.isClosed as isClosed,store.certificate_url as certificate_url,store.certificate_type as certificate_type,store.rating as rating,
        store.total_rating as total_rating,store.cid as cid,store.zipcode as zipcode,store.status as status, ( ' . $values . ' * acos( cos( radians(' . $request->lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $request->lng . ') ) + sin( radians(' . $request->lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
            ->having('distance', '<', $settings->search_radius)
            ->orderBy('distance')
            ->where('store.status', 1)
            ->get();

        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchWithGeoLocation(ProductsByLocationRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'lat'=>'required',
        //     'lng' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        if (2 == 1) {
            $values = 3959; // miles
            $distanceType = 'miles';
        } else {
            $values = 6371; // km
            $distanceType = 'km';
        }
        $today = Carbon::now();
        $settings = DB::table('settings')->select('search_radius')->first();
        \DB::enableQueryLog();
        $stores = Stores::select(DB::raw('store.id as id,store.uid as uid,store.name as name,store.mobile as mobile,store.lat as lat,store.lng as lng,
        store.verified as verified,store.address as address,store.descriptions as descriptions,store.images as images,store.cover as cover,store.open_time as open_time,
        store.close_time as close_time,store.isClosed as isClosed,store.certificate_url as certificate_url,store.certificate_type as certificate_type,store.rating as rating,
        store.total_rating as total_rating,store.cid as cid,store.zipcode as zipcode,store.status as status, ( ' . $values . ' * acos( cos( radians(' . $request->lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $request->lng . ') ) + sin( radians(' . $request->lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
            ->having('distance', '<', $settings->search_radius)
            ->orderBy('distance')
            ->where('store.status', 1)
            ->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $cityId = $stores[0]->cid;
            $banners = Banners::where(['status' => 1, 'city_id' => $cityId])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $category = Category::where('status', 1)->get();
            $homeProducts = Products::where(['status' => 1, 'in_home' => 1])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit(15)->get();
            $inOffers = Products::where('status', 1)->where('discount', '>', 0)->WhereIn('store_id', $storeIds)->orderBy('discount', 'desc')->limit(15)->get();
            $topProducts = Products::where(['status' => 1, 'in_home' => 1])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit(15)->get();
            $city = Cities::where('id', $cityId)->first();
            foreach ($category as $loop) {
                $loop->subCates = SubCategory::where(['status' => 1, 'cate_id' => $loop->id])->get();
            }

            $data = [
                'stores' => $stores,
                'banners' => $banners,
                'category' => $category,
                'topProducts' => $topProducts,
                'inOffers' => $inOffers,
                'storeIds' => $storeIds,
                'homeProducts' => $homeProducts,
                'cityInfo' => $city,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getWithSubCategory(ProductsBySubCategoryRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id'=>'required',
        //     'storeIds'=>'required',
        //     'sub' => 'required',
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $ids = explode(',', $request->storeIds);
        $products = Products::where(['status' => 1, 'cate_id' => $request->id, 'sub_cate_id' => $request->sub])->WhereIn('store_id', $ids)->orderBy('name', 'asc')->limit($request->limit)->get();
        $response = [
            'data' => $products,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getWithSubCategoryId(ProductsBySubCategoryRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id'=>'required',
        //     'storeIds'=>'required',
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $ids = explode(',', $request->storeIds);
        $products = Products::where(['status' => 1, 'sub_cate_id' => $request->id])->WhereIn('store_id', $ids)->orderBy('name', 'asc')->limit($request->limit)->get();
        $response = [
            'data' => $products,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchQuery(ProductsBySearchRequest $request)
    {
        $str = "";
        $products = Products::select('id', 'name', 'store_id', 'cover')->where('status', 1);

        if ($request->has('param')) {
            $str = $request->param;
            // TODO: Generate products based on parameters
            $products = Products::where('name', 'like', '%' . $str . '%')->orderBy('name', 'asc')->limit(5)->get();
        }

        if ($request->has('search_instores')) {
            $stores = $request->search_instores;
            $ids = explode(',', $stores);
            // TODO: Generate products based on parameters or avaiable stores
            $products = Products::whereIn('store_id', $ids)->orderBy('name', 'asc')->limit(5)->get();
        }

        $response = [
            'data' => $products,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getByStoreId(ProductsStoreWitLimitsRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id'=>'required',
        //     'limit'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        // dump($request->id);
        $data = Products::where(['status' => 1, 'store_id' => $request->id])->orderBy('name', 'asc')->limit($request->limit)->get();
        info('test');
        $storeInfo = Stores::select('id', 'uid', 'name', 'status', 'zipcode', 'cid')->where('uid', $request->id)->first();
        $response = [
            'data' => $data,
            'storeInfo' => $storeInfo,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getByStoreIdStoreAll(ProductsWitLimitsRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'id'=>'required',
        //     'limit'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $data = Products::where(['store_id' => $request->id])->orderBy('name', 'asc')->limit($request->limit)->get();
        $storeInfo = Stores::select('id', 'uid', 'name', 'status', 'zipcode', 'cid')->where('uid', $request->id)->first();
        $response = [
            'data' => $data,
            'storeInfo' => $storeInfo,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getByIdgetByIdStore(ProductsByIdRequest $request)
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

        $data = Products::find($request->id);


        if (is_null($data)) {
            $response = [
                'success' => false,
                'message' => 'Data not found.',
                'status' => 404
            ];
            return response()->json($response, 404);
        }
        $category = Category::where('id', $data->cate_id)->first();
        $subCategory = SubCategory::where('id', $data->sub_cate_id)->first();
        $response = [
            'data' => $data,
            'category' => $category,
            'subCategory' => $subCategory,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getTopRated(ProductsStoreRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'storeIds'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $ids = explode(',', $request->product_store_id);
        $homeProducts = Products::where(['status' => 1, 'in_home' => 1])->WhereIn('store_id', $ids)->orderBy('rating', 'desc')->limit(15)->get();
        $topProducts = Products::where('status', 1)->orWhere('in_home', 1)->WhereIn('store_id', $ids)->orderBy('rating', 'desc')->limit(15)->get();
        $response = [
            'topProducts' => $topProducts,
            'homeProducts' => $homeProducts,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }


    public function getInOffers(ProductsStoreRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'storeIds'=>'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $ids = explode(',', $request->product_store_id);
        $data = Products::where('status', 1)->where('discount', '>', 0)->WhereIn('store_id', $ids)->orderBy('discount', 'desc')->limit(15)->get();
        $response = [
            'data' => $data,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchStoreWithZipCode(ProductsStoreByZipcodeRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'zipcode' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $stores = Stores::where(['status' => 1, 'zipcode' => $request->zipcode])->get();
        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchWithZipCode(ProductsByZipcodeRequest $request)
    {
        $zipcode = $request->zipcode;
        if ($zipcode == null || !$zipcode || !isset($zipcode)) {
            $settings = Settings::first();
            $zipcode = $settings->default_delivery_zip;
        }
        $today = Carbon::now();
        $stores = Stores::where(['status' => 1, 'zipcode' => $zipcode])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $cityId = $stores[0]->cid;
            $banners = Banners::where(['status' => 1, 'city_id' => $cityId])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $category = Category::where('status', 1)->get();
            $homeProducts = Products::where(['status' => 1, 'in_home' => 1])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit(15)->get();
            $inOffers = Products::where('status', 1)->where('discount', '>', 0)->WhereIn('store_id', $storeIds)->orderBy('discount', 'desc')->limit(15)->get();
            $topProducts = Products::where(['status' => 1, 'in_home' => 1])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit(15)->get();
            $city = Cities::where('id', $cityId)->first();
            foreach ($category as $loop) {
                $loop->subCates = SubCategory::where(['status' => 1, 'cate_id' => $loop->id])->get();
            }

            $data = [
                'stores' => $stores,
                'banners' => $banners,
                'category' => $category,
                'topProducts' => $topProducts,
                'homeProducts' => $homeProducts,
                'inOffers' => $inOffers,
                'storeIds' => $storeIds,
                'cityInfo' => $city,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchStoreWithCity(ProductsStoreCityRequest $request)
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
        $stores = Stores::where(['status' => 1, 'cid' => $request->product_store_city_id])->get();
        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function searchWithCity(ProductsSearchByCityRequest $request, $sector = 'personal')
    {
        $today = Carbon::now();
        $cid = $request->id;
        if ($cid == null || !$cid || !isset($cid)) {
            $settings = Settings::first();
            $cid = $settings->default_city_id;
        }
        $stores = Stores::where(['status' => 1, 'cid' => $cid])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $banners = Banners::where(['status' => 1, 'city_id' => $cid])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $category = Subcategory::where('status', 1)->where('sector', $sector)->limit(7)->orderBy('order')->get();
            $homeProducts = Products::where(['status' => 1, 'in_home' => 1])->where('rating', '>', 0)->limit(15)->get(); // ->WhereIn('store_id', $storeIds)
            $topProducts = Products::where(['status' => 1, 'in_home' => 1])->orderBy('rating', 'desc')->limit(15)->get(); //->WhereIn('store_id', $storeIds)
            $inOffers = Products::where('status', 1)->where('discount', '>', 0)->orderBy('discount', 'desc')->limit(15)->get();// ->WhereIn('store_id', $storeIds)
            $city = Cities::where('id', $cid)->first();
            foreach ($category as $loop) {
                $loop->subCates = SubCategory::where(['status' => 1, 'cate_id' => $loop->id])->get();
            }

            $data = [
                'stores' => $stores,
                'banners' => $banners,
                'category' => $category,
                'topProducts' => $topProducts,
                'homeProducts' => $homeProducts,
                'inOffers' => $inOffers,
                'storeIds' => $storeIds,
                'cityInfo' => $city,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getProductsWithCity(ProductsCategoriesWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'catID' => 'required',
        //     'subId' => 'required',
        //     'limit' => 'required',
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
        $cid = $request->id;
        if ($cid == null || !$cid || !isset($cid)) {
            $settings = Settings::first();
            $cid = $settings->default_city_id;
        }
        $stores = Stores::where(['status' => 1, 'cid' => $cid])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $banners = Banners::where(['status' => 1, 'city_id' => $cid])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $products = Products::where(['status' => 1, 'cate_id' => $request->catID, 'sub_cate_id' => $request->subId])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();

            $data = [
                'banners' => $banners,
                'products' => $products,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getProductsWithSlugs(ProductsCategoriesWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'catID' => 'required',
        //     'subId' => 'required',
        //     'limit' => 'required',
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
        $cid = $request->id;
        if ($cid == null || !$cid || !isset($cid)) {
            $settings = Settings::first();
            $cid = $settings->default_city_id;
        }
        $stores = Stores::where(['status' => 1, 'cid' => $cid])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $banners = Banners::where(['status' => 1, 'city_id' => $cid])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $products = Products::where(['status' => 1, 'cate_id' => $request->catID, 'sub_cate_id' => $request->subId])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();

            $data = [
                'banners' => $banners,
                'products' => $products,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getProductsWithZipCodes(ProductsByZipcodeRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'catID' => 'required',
        //     'subId' => 'required',
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $zipcode = $request->zipcode;
        if ($zipcode == null || !$zipcode || !isset($zipcode)) {
            $settings = Settings::first();
            $zipcode = $settings->default_delivery_zip;
        }
        $today = Carbon::now();
        $stores = Stores::where(['status' => 1, 'zipcode' => $zipcode])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $cityId = $stores[0]->cid;
            $banners = Banners::where(['status' => 1, 'city_id' => $cityId])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $products = Products::where(['status' => 1, 'cate_id' => $request->catID, 'sub_cate_id' => $request->subId])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();

            $data = [
                'banners' => $banners,
                'products' => $products,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getProductsWithLocation(ProductsLocationWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'lat'=>'required',
        //     'lng' => 'required',
        //     'catID' => 'required',
        //     'subId' => 'required',
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        if (2 == 1) {
            $values = 3959; // miles
            $distanceType = 'miles';
        } else {
            $values = 6371; // km
            $distanceType = 'km';
        }
        $today = Carbon::now();
        $settings = DB::table('settings')->select('search_radius')->first();
        \DB::enableQueryLog();
        $stores = Stores::select(DB::raw('store.id as id,store.uid as uid,store.name as name,store.mobile as mobile,store.lat as lat,store.lng as lng,
        store.verified as verified,store.address as address,store.descriptions as descriptions,store.images as images,store.cover as cover,store.open_time as open_time,
        store.close_time as close_time,store.isClosed as isClosed,store.certificate_url as certificate_url,store.certificate_type as certificate_type,store.rating as rating,
        store.total_rating as total_rating,store.cid as cid,store.zipcode as zipcode,store.status as status, ( ' . $values . ' * acos( cos( radians(' . $request->lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $request->lng . ') ) + sin( radians(' . $request->lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
            ->having('distance', '<', $settings->search_radius)
            ->orderBy('distance')
            ->where('store.status', 1)
            ->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $cityId = $stores[0]->cid;
            $banners = Banners::where(['status' => 1, 'city_id' => $cityId])->whereDate('from', '<=', $today)->whereDate('to', '>=', $today)->get();
            $products = Products::where(['status' => 1, 'cate_id' => $request->catID, 'sub_cate_id' => $request->subId])->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();

            $data = [
                'banners' => $banners,
                'products' => $products,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getTopRateProductsWithCity(ProductsCityWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'limit' => 'required',
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
        $cid = $request->id;
        if ($cid == null || !$cid || !isset($cid)) {
            $settings = Settings::first();
            $cid = $settings->default_city_id;
        }
        $stores = Stores::where(['status' => 1, 'cid' => $cid])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();

            $topProducts = Products::where('status', 1)->orWhere('in_home', 1)->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();
            $data = [
                'products' => $topProducts,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getTopRateProductsWithLocation(ProductsLocationWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'lat'=>'required',
        //     'lng' => 'required',
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        if (2 == 1) {
            $values = 3959; // miles
            $distanceType = 'miles';
        } else {
            $values = 6371; // km
            $distanceType = 'km';
        }
        $today = Carbon::now();
        $settings = DB::table('settings')->select('search_radius')->first();
        \DB::enableQueryLog();
        $stores = Stores::select(DB::raw('store.id as id,store.uid as uid,store.name as name,store.mobile as mobile,store.lat as lat,store.lng as lng,
        store.verified as verified,store.address as address,store.descriptions as descriptions,store.images as images,store.cover as cover,store.open_time as open_time,
        store.close_time as close_time,store.isClosed as isClosed,store.certificate_url as certificate_url,store.certificate_type as certificate_type,store.rating as rating,
        store.total_rating as total_rating,store.cid as cid,store.zipcode as zipcode,store.status as status, ( ' . $values . ' * acos( cos( radians(' . $request->lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $request->lng . ') ) + sin( radians(' . $request->lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
            ->having('distance', '<', $settings->search_radius)
            ->orderBy('distance')
            ->where('store.status', 1)
            ->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $topProducts = Products::where('status', 1)->orWhere('in_home', 1)->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();
            $data = [
                'products' => $topProducts,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getTopRateProductsWithZipcodes(ProductsByZipcodeWithLimitsRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $zipcode = $request->zipcode;
        if ($zipcode == null || !$zipcode || !isset($zipcode)) {
            $settings = Settings::first();
            $zipcode = $settings->default_delivery_zip;
        }
        $today = Carbon::now();
        $stores = Stores::where(['status' => 1, 'zipcode' => $zipcode])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $topProducts = Products::where('status', 1)->orWhere('in_home', 1)->WhereIn('store_id', $storeIds)->orderBy('rating', 'desc')->limit($request->limit)->get();
            $data = [
                'products' => $topProducts,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getOffersProductsWithCity(ProductsCityWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'limit' => 'required',
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
        $cid = $request->product_city_id;
        if ($cid == null || !$cid || !isset($cid)) {
            $settings = Settings::first();
            $cid = $settings->default_city_id;
        }
        $stores = Stores::where(['status' => 1, 'cid' => $cid])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $inOffers = Products::where('status', 1)->where('discount', '>', 0)->WhereIn('store_id', $storeIds)->orderBy('discount', 'desc')->limit($request->limit)->get();
            $data = [
                'products' => $inOffers,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getOffersProductsWithLocation(ProductsLocationWithLimitRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'lat'=>'required',
        //     'lng' => 'required',
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        if (2 == 1) {
            $values = 3959; // miles
            $distanceType = 'miles';
        } else {
            $values = 6371; // km
            $distanceType = 'km';
        }
        $today = Carbon::now();
        $settings = DB::table('settings')->select('search_radius')->first();
        \DB::enableQueryLog();
        $stores = Stores::select(DB::raw('store.id as id,store.uid as uid,store.name as name,store.mobile as mobile,store.lat as lat,store.lng as lng,
        store.verified as verified,store.address as address,store.descriptions as descriptions,store.images as images,store.cover as cover,store.open_time as open_time,
        store.close_time as close_time,store.isClosed as isClosed,store.certificate_url as certificate_url,store.certificate_type as certificate_type,store.rating as rating,
        store.total_rating as total_rating,store.cid as cid,store.zipcode as zipcode,store.status as status, ( ' . $values . ' * acos( cos( radians(' . $request->lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $request->lng . ') ) + sin( radians(' . $request->lat . ') ) * sin( radians( lat ) ) ) ) AS distance'))
            ->having('distance', '<', $settings->search_radius)
            ->orderBy('distance')
            ->where('store.status', 1)
            ->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $inOffers = Products::where('status', 1)->where('discount', '>', 0)->WhereIn('store_id', $storeIds)->orderBy('discount', 'desc')->limit($request->limit)->get();
            $data = [
                'products' => $inOffers,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => $stores,
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }

    public function getOffersProductsWithZipcodes(ProductsByZipcodeWithLimitsRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'limit' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $response = [
        //         'success' => false,
        //         'message' => 'Validation Error.', $validator->errors(),
        //         'status'=> 500
        //     ];
        //     return response()->json($response, 404);
        // }
        $zipcode = $request->zipcode;
        if ($zipcode == null || !$zipcode || !isset($zipcode)) {
            $settings = Settings::first();
            $zipcode = $settings->default_delivery_zip;
        }
        $today = Carbon::now();
        $stores = Stores::where(['status' => 1, 'zipcode' => $zipcode])->get();
        if (count($stores)) {
            $storeIds = $stores->pluck('uid')->toArray();
            $inOffers = Products::where('status', 1)->where('discount', '>', 0)->WhereIn('store_id', $storeIds)->orderBy('discount', 'desc')->limit($request->limit)->get();
            $data = [
                'products' => $inOffers,
            ];
            $response = [
                'data' => $data,
                'success' => true,
                'status' => 200,
            ];
            return response()->json($response, 200);
        }
        $response = [
            'data' => null,
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

                    if (count($header) == count($row)) {
                        $row = array_combine($header, $row);
                        $insertInfo =  array(
                            'id' => $row['id'],
                            'store_id' => $row['store_id'],
                            'cover' => $row['cover'],
                            'name' => $row['name'],
                            'images' => $row['images'],
                            'original_price' => $row['original_price'],
                            'sell_price' => $row['sell_price'],
                            'discount' => $row['discount'],
                            'kind' => $row['kind'],
                            'cate_id' => $row['cate_id'],
                            'sub_cate_id' => $row['sub_cate_id'],
                            'in_home' => $row['in_home'],
                            'is_single' => $row['is_single'],
                            'have_gram' => $row['have_gram'],
                            'gram' => $row['gram'],
                            'have_kg' => $row['have_kg'],
                            'kg' => $row['kg'],
                            'have_pcs' => $row['have_pcs'],
                            'pcs' => $row['pcs'],
                            'have_liter' => $row['have_liter'],
                            'liter' => $row['liter'],
                            'have_ml' => $row['have_ml'],
                            'ml' => $row['ml'],
                            'descriptions' => $row['descriptions'],
                            'key_features' => $row['key_features'],
                            'disclaimer' => $row['disclaimer'],
                            'exp_date' => $row['exp_date'],
                            'type_of' => $row['type_of'],
                            'in_store' => $row['in_store'],
                            'rating' => $row['rating'],
                            'total_rating' => $row['total_rating'],
                            'status' => $row['status'],
                            'in_offer' => $row['in_offer'],
                            'variations' => $row['variations'],
                            'size' => $row['size'],
                        );
                        $checkLead  =  Products::where("id", "=", $row["id"])->first();
                        if (!is_null($checkLead)) {
                            DB::table('products')->where("id", "=", $row["id"])->update($insertInfo);
                        } else {
                            DB::table('products')->insert($insertInfo);
                        }
                    }
                }
            }
        }
        $response = [
            'data' => 'Done',
            'success' => true,
            'status' => 200,
        ];
        return response()->json($response, 200);
    }
}
