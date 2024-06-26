<?php

namespace Database\Seeders;

use App\Helpers\UuidGeneratorHelper;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesAndProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the tables to clear existing data and reset auto-increment ID
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            'Fire' => [
                'Bharat Griha Raksha',
                'Bhrat Sukhma Udyam',
                'Bharat Laghu Udyam',
                'Standard Fire and Special Peril',
                'Industrial All Risk',
            ],
            'Engineering' => [
                'Contractor All Risk (CAR)',
                'Erection All Risk (EAR)',
                'Contractors Plant and Machinery (CPM)',
            ],
            'Health' => [
                'Retail Health',
                'Personal Accident',
                'Group Mediclaim',
                'Group Personal Accident',
            ],
            'Marine Hull' => [
                'Single Transit',
            ],
            'Marine Cargo' => [
                'Import Export Policy',
                'Inland Policy',
                'Sales Turnover Policy',
            ],
            'Liability' => [
                'Directors and Officers Liability',
                'Professional Indemnity',
                'Comprehensive General Liability',
                'Workman Compensation',
                'Cyber Liability',
                'Crime Insurance',
                'Public offering securities insurance (POSI)',
                'Credit Insurance',
            ],
            'Motor' => [
                '2w',
                '3W',
                'Pvt Car',
                'PCV',
                'GCV',
                'MISD',
            ],
            'Misc' => [],
        ];

        foreach ($categories as $categoryName => $products) {
            $category = Category::create([
                'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('categories'),
                'name' => $categoryName
            ]);
            foreach ($products as $productName) {
                Product::create([
                    'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('products'),
                    'name' => $productName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
