<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::truncate();

        // Add Products

        Products::create([
            'store_id' => 1,
            'cover' => 'products/cement.jpg',
            'name' => 'Dangote Cement',
            'slug' => 'dangote-cement',
            'images' => 'products/cement.jpg',
            'cid' => 4,
            'original_price' => 28000.00,
            'sell_price' => 25200.00,
            'discount' => 10.00,
            'kind' => 0, // 1 = installers required, 0 = no instalers required
            'cate_id' => 1,
            'sub_cate_id' => 2,
            'in_home' => 1,
            'is_single' => 1,
            // 'have_gram' => ,
            // 'gram' => '',
            // 'have_kg' => 1,
            // 'kg' => '256kg',
            // 'have_pcs' => '',
            // 'pcs' => '',
            // 'have_liter' => '',
            // 'liter' => '',
            // 'have_ml' => '',
            // 'ml' => '',
            'descriptions' => 'cement samples',
            'key_features' => '',
            // 'disclaimer' => '',
            // 'exp_date' => '',
            'type_of' => 0,
            // 'in_offer' => '',
            // 'in_store' => 1,
            // 'rating' => 1,
            // 'total_rating' => 25,
            'variations' => null,
            'size' => 0,
            'status' => 1
        ]);

        // 2
        Products::create([
            'store_id' => 1,
            'cover' => 'products/concrete.jpg',
            'name' => 'Concrete',
            'slug' => 'default-concrete',
            'images' => 'products/concrete.jpg',
            'cid' => 4,
            'original_price' => 35000.00,
            'sell_price' => 32200.00,
            'discount' => 8.00,
            'kind' => 0, // 1 = installers required, 0 = no instalers required
            'cate_id' => 1,
            'sub_cate_id' => 1,
            'in_home' => 1,
            'is_single' => 1,
            // 'have_gram' => ,
            // 'gram' => '',
            // 'have_kg' => 1,
            // 'kg' => '256kg',
            // 'have_pcs' => '',
            // 'pcs' => '',
            // 'have_liter' => '',
            // 'liter' => '',
            // 'have_ml' => '',
            // 'ml' => '',
            'descriptions' => 'Concrete samples',
            'key_features' => 'cement, water, sand, gravel',
            // 'disclaimer' => '',
            // 'exp_date' => '',
            'type_of' => 0,
            // 'in_offer' => '',
            // 'in_store' => 1,
            // 'rating' => 1,
            // 'total_rating' => 25,
            'variations' => null,
            'size' => 0,
            'status' => 1
        ]);
    }
}
