<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::truncate();

        // Add SubCategory

        SubCategory::create([
            'name' => 'Mixed',
            'slug' => 'mixed',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 18,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Cement',
            'slug' => 'cement',
            // 'cover' => 'categories/cement.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 1,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Sands',
            'slug' => 'sands',
            // 'cover' => 'categories/sand.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 2,
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Blocks',
            'slug' => 'blocks',
            // 'cover' => 'categories/block.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 3,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Scafoldings',
            'slug' => 'scafoldings',
            // 'cover' => 'categories/scafold.jpg',
            'cate_id' => 2,
            'sector' => 'personal',
            'order' => 4,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Woods',
            'slug' => 'woods',
            // 'cover' => 'categories/wood.jpg',
            'cate_id' => 3,
            'sector' => 'personal',
            'order' => 5,
            'status' => 1
        ]);

        
        SubCategory::create([
            'name' => 'Roofings',
            'slug' => 'roofings',
            // 'cover' => 'categories/roof.jpg',
            'cate_id' => 4,
            'sector' => 'personal',
            'order' => 6,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Irons',
            'slug' => 'irons',
            // 'cover' => 'categories/iron.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 6,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Nails',
            'slug' => 'nails',
            // 'cover' => 'categories/nail.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 7,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Screws',
            'slug' => 'screws',
            // 'cover' => 'categories/screw.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 8,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Steels',
            'slug' => 'steels',
            // 'cover' => 'categories/steel.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 9,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Ceremics',
            'slug' => 'ceremics',
            // 'cover' => 'categories/ceramic.jpg',
            'cate_id' => 6,
            'sector' => 'personal',
            'order' => 10,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Stones',
            'slug' => 'stones',
            // 'cover' => 'categories/stone.jpg',
            'cate_id' => 7,
            'sector' => 'personal',
            'order' => 11,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Electricals',
            'slug' => 'electricals',
            // 'cover' => 'categories/electrical.jpg',
            'cate_id' => 8,
            'sector' => 'personal',
            'order' => 12,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Solars',
            'slug' => 'solars',
            // 'cover' => 'categories/solar.jpg',
            'cate_id' => 8,
            'sector' => 'personal',
            'order' => 13,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Bins',
            'slug' => 'bins',
            // 'cover' => 'categories/bin.jpg',
            'cate_id' => 9,
            'sector' => 'personal',
            'order' => 14,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Toilets',
            'slug' => 'toilets',
            // 'cover' => 'categories/toilets.jpg',
            'cate_id' => 9,
            'sector' => 'personal',
            'order' => 15,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Mixers',
            'slug' => 'mixers',
            // 'cover' => 'categories/mixer.jpg',
            'cate_id' => 9,
            'sector' => 'personal',
            'order' => 16,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Brands',
            'slug' => 'brands',
            // 'cover' => 'categories/brand.jpg',
            'cate_id' => 10,
            'sector' => 'personal',
            'order' => 16,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Discounts',
            'slug' => 'discounts',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 10,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Post weds',
            'slug' => 'post-weds',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 18,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Kitchen',
            'slug' => 'kitchen',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Bath-rooms',
            'slug' => 'bathrooms',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Bed-rooms',
            'slug' => 'bedrooms',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Living-rooms',
            'slug' => 'livingrooms',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Personal Houses',
            'slug' => 'personalhouses',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Public buildings',
            'slug' => 'publicbuildings',
            // 'cover' => 'categories/discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Mixed',
            'slug' => 'mixed',
            // 'cover' => 'categories/concrete.jpg',
            'cate_id' => 11,
            'order' => 1,
            'sector' => 'industrial',
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Cement',
            'slug' => 'cement',
            // 'cover' => 'categories/cement.jpg',
            'cate_id' => 11,
            'order' => 2,
            'sector' => 'industrial',
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Sands',
            'slug' => 'sands',
            // 'cover' => 'categories/sand.jpg',
            'cate_id' => 11,
            'order' => 3,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Blocks',
            'slug' => 'blocks',
            // 'cover' => 'categories/block.jpg',
            'cate_id' => 11,
            'order' => 4,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Asphalt',
            // 'cover' => 'categories/',
            'slug' => 'asphalt',
            'cate_id' => 14, // Asphalt
            'order' => 5,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Roller Vehicles',
            // 'cover' => 'categories/',
            'slug' => 'rollervehicles',
            'cate_id' => 15, // rentables
            'order' => 6,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Roads',
            // 'cover' => 'categories/',
            'slug' => 'roads',
            'cate_id' => 22, // usecases
            'order' => 6,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Bridges',
            // 'cover' => 'categories/',
            'slug' => 'bridges',
            'cate_id' => 22, // usecases
            'order' => 6,
            'sector' => 'industrial',
            'status' => 1
        ]);
    }
}
