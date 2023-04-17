<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        
        // Add Categories
        // 1
        Category::create([
            'name' => 'Concrete',
            'slug' => 'concrete',
            'sector' => 'personal',
            'cover' => 'concrete.jpg',
            'order' => 1,
            'status' => 1
        ]);

        // 2
        Category::create([
            'name' => 'Scafolds',
            'slug' => 'scafold',
            'sector' => 'personal',
            'order' => 2,
            'status' => 1
        ]);
        
        // 3
        Category::create([
            'name' => 'Woods',
            'slug' => 'wood',
            'sector' => 'personal',
            'order' => 3,
            'status' => 1
        ]);
        
        // 4
        Category::create([
            'name' => 'Roofings',
            'slug' => 'roofing',
            'sector' => 'personal',
            // 'cover' => 'roof.jpg',
            'order' => 4,
            'status' => 1
        ]);
        
        // 5
        Category::create([
            'name' => 'Irons',
            'slug' => 'iron-nails-steels',
            'sector' => 'personal',
            'order' => 5,
            'status' => 1
        ]);
        
        // 6
        Category::create([
            'name' => 'Ceramics',
            'slug' => 'ceramics',
            'sector' => 'personal',
            // 'slug' => 'ceramics-stones-asphalts',
            'order' => 6,
            'status' => 1
        ]);

        // 7
        Category::create([
            'name' => 'Stones',
            'slug' => 'stones',
            'sector' => 'personal',
            'order' => 7,
            'status' => 1
        ]);

        // 8
        Category::create([
            'name' => 'Electricals',
            'slug' => 'electricals-solar',
            'sector' => 'personal',
            // 'cover' => 'electrical.jpg',
            'order' => 8,
            'status' => 1
        ]);

        // 9
        Category::create([
            'name' => 'Rentables',
            'slug' => 'rentables',
            'sector' => 'personal',
            'order' => 9,
            'status' => 1
        ]);

        // 10
        // Category::create([
        //     'name' => 'Discounts',
        //     'slug' => 'discounts',
        //     'sector' => 'personal',
        //     'order' => 10,
        //     'status' => 1
        // ]);

        // Category::create([
        //     'name' => 'Use Cases',
        //     'slug' => 'use-case',
        //     'sector' => 'personal',
        //     'order' => 10,
        //     'status' => 1
        // ]);

        Category::create([
            'name' => 'Concrete',
            'slug' => 'concrete-wholesale',
            'sector' => 'wholesales',
            'cover' => 'concrete.jpg',
            'order' => 1,
            'status' => 1
        ]);

        // 2
        Category::create([
            'name' => 'Scafolds',
            'slug' => 'scafold-wholesale',
            'sector' => 'wholesales',
            'order' => 2,
            'status' => 1
        ]);
        
        // 3
        Category::create([
            'name' => 'Woods',
            'slug' => 'wood-wholesale',
            'sector' => 'wholesales',
            'order' => 3,
            'status' => 1
        ]);
        
        // 4
        Category::create([
            'name' => 'Roofings',
            'slug' => 'roofing-wholesale',
            'sector' => 'wholesales',
            'cover' => 'roof.jpg',
            'order' => 4,
            'status' => 1
        ]);
        
        // 5
        Category::create([
            'name' => 'Irons',
            'slug' => 'iron-nails-steels-wholesale',
            'sector' => 'wholesales',
            'order' => 5,
            'status' => 1
        ]);
        
        // 6
        Category::create([
            'name' => 'Ceramics',
            'slug' => 'ceramics-wholesale',
            'sector' => 'wholesales',
            'order' => 6,
            'status' => 1
        ]);

        // 7
        Category::create([
            'name' => 'Stones',
            'slug' => 'stones-wholesale',
            'sector' => 'wholesales',
            'order' => 7,
            'status' => 1
        ]);

        // 8
        Category::create([
            'name' => 'Electricals',
            'slug' => 'electricals-wholesale',
            'sector' => 'wholesales',
            'cover' => 'electrical.jpg',
            'order' => 8,
            'status' => 1
        ]);

        // 9
        Category::create([
            'name' => 'Rentables',
            'slug' => 'rentables-wholesale',
            'sector' => 'wholesales',
            'order' => 9,
            'status' => 1
        ]);

        // 10
        Category::create([
            'name' => 'Discounts',
            'slug' => 'discounts-wholesale',
            'sector' => 'wholesales',
            'order' => 10,
            'status' => 1
        ]);
        
        // 11
        Category::create([
            'name' => 'Concrete',
            'slug' => 'concrete-industrial',
            'sector' => 'industrial',
            'order' => 1,
            'status' => 1
        ]);

        // 12
        Category::create([
            'name' => 'Pavements',
            'slug' => 'pavements-industrial',
            'sector' => 'industrial',
            'order' => 2,
            'status' => 1
        ]);

        // 13
        Category::create([
            'name' => 'Composite & Recycled',
            'slug' => 'composite-recycled-industrial',
            'sector' => 'industrial',
            'order' => 3,
            'status' => 1
        ]);

        // 14
        Category::create([
            'name' => 'Asphalt',
            'slug' => 'asphalt-industrial',
            'sector' => 'industrial',
            'order' => 5,
            'status' => 1
        ]);

        // 15
        Category::create([
            'name' => 'Rentables',
            'slug' => 'rentables-industrial',
            'sector' => 'industrial',
            'order' => 4,
            'status' => 1
        ]);

        // Category::create([
        //     'name' => 'Use Cases',
        //     'slug' => 'use-case-industrial',
        //     'sector' => 'industrial',
        //     'order' => 6,
        //     'status' => 1
        // ]);
    }
}
