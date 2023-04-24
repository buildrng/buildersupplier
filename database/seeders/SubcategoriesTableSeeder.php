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
            'name' => 'Mixed Concrete',
            'slug' => 'mixed',
            'cover' => 'mixed.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 18,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Cement',
            'slug' => 'cement',
            'cover' => 'cement.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 1,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Sands',
            'slug' => 'sands',
            'cover' => 'sand.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 2,
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Blocks',
            'slug' => 'blocks',
            'cover' => 'block.jpg',
            'cate_id' => 1,
            'sector' => 'personal',
            'order' => 3,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Scafoldings',
            'slug' => 'scafoldings',
            'cover' => 'scafold.jpg',
            'cate_id' => 2,
            'sector' => 'personal',
            'order' => 4,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Woods',
            'slug' => 'woods',
            'cover' => 'wood.jpg',
            'cate_id' => 3,
            'sector' => 'personal',
            'order' => 5,
            'status' => 1
        ]);

        
        SubCategory::create([
            'name' => 'Roofings',
            'slug' => 'roofings',
            'cover' => 'roof.jpg',
            'cate_id' => 4,
            'sector' => 'personal',
            'order' => 6,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Irons',
            'slug' => 'irons',
            'cover' => 'iron.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 6,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Nails',
            'slug' => 'nails',
            'cover' => 'nail.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 7,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Screws',
            'slug' => 'screws',
            'cover' => 'screw.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 8,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Steels',
            'slug' => 'steels',
            'cover' => 'steel.jpg',
            'cate_id' => 5,
            'sector' => 'personal',
            'order' => 9,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Ceramics',
            'slug' => 'ceramics',
            'cover' => 'ceramic.jpg',
            'cate_id' => 6,
            'sector' => 'personal',
            'order' => 10,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Stones',
            'slug' => 'stones',
            'cover' => 'stone.jpg',
            'cate_id' => 7,
            'sector' => 'personal',
            'order' => 11,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Electricals',
            'slug' => 'electricals',
            'cover' => 'electrical.jpg',
            'cate_id' => 8,
            'sector' => 'personal',
            'order' => 12,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Solars',
            'slug' => 'solars',
            'cover' => 'solar.jpg',
            'cate_id' => 8,
            'sector' => 'personal',
            'order' => 13,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Bins',
            'slug' => 'bins',
            'cover' => 'bin.jpg',
            'cate_id' => 9,
            'sector' => 'personal',
            'order' => 14,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Toilets',
            'slug' => 'toilets',
            'cover' => 'toilets.jpg',
            'cate_id' => 9,
            'sector' => 'personal',
            'order' => 15,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Brands',
            'slug' => 'brands',
            // 'cover' => 'brand.jpg',
            'cate_id' => 10,
            'sector' => 'personal',
            'order' => 16,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Discounts',
            'slug' => 'discounts',
            // 'cover' => 'discount.jpg',
            'cate_id' => 10,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Post weds',
            'slug' => 'post-weds',
            // 'cover' => 'discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 18,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Kitchen',
            'slug' => 'kitchen',
            // 'cover' => 'discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Bath-rooms',
            'slug' => 'bathrooms',
            // 'cover' => 'discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Living-rooms',
            'slug' => 'livingrooms',
            // 'cover' => 'discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Personal Houses',
            'slug' => 'personalhouses',
            // 'cover' => 'discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Public buildings',
            'slug' => 'publicbuildings',
            // 'cover' => 'discount.jpg',
            'cate_id' => 11,
            'sector' => 'personal',
            'order' => 17,
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Mixed',
            'slug' => 'mixed',
            // 'cover' => 'concrete.jpg',
            'cate_id' => 11,
            'order' => 1,
            'sector' => 'industrial',
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Cement',
            'slug' => 'cement',
            // 'cover' => 'cement.jpg',
            'cate_id' => 11,
            'order' => 2,
            'sector' => 'industrial',
            'status' => 1
        ]);

        SubCategory::create([
            'name' => 'Sands',
            'slug' => 'sands',
            // 'cover' => 'sand.jpg',
            'cate_id' => 11,
            'order' => 3,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Blocks',
            'slug' => 'blocks',
            // 'cover' => 'block.jpg',
            'cate_id' => 11,
            'order' => 4,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Asphalt',
            // 'cover' => '',
            'slug' => 'asphalt',
            'cate_id' => 14, // Asphalt
            'order' => 5,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Roller Vehicles',
            // 'cover' => '',
            'slug' => 'rollervehicles',
            'cate_id' => 15, // rentables
            'order' => 6,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Roads',
            // 'cover' => '',
            'slug' => 'roads',
            'cate_id' => 22, // usecases
            'order' => 6,
            'sector' => 'industrial',
            'status' => 1
        ]);
        
        SubCategory::create([
            'name' => 'Bridges',
            // 'cover' => '',
            'slug' => 'bridges',
            'cate_id' => 22, // usecases
            'order' => 6,
            'sector' => 'industrial',
            'status' => 1
        ]);
    }
}
