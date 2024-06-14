<?php

namespace Database\Seeders\Product;

use App\Models\Product\ProductType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(ProductType::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(ProductType::table)->insert([
            [
                ProductType::productType => 'women\'s clothing',
                ProductType::companyTypeId => 1,
                ProductType::createdAt => Carbon::now(),
                ProductType::updatedAt => Carbon::now(),
            ],
            [
                ProductType::productType => 'men\'s clothing',
                ProductType::companyTypeId => 1,
                ProductType::createdAt => Carbon::now(),
                ProductType::updatedAt => Carbon::now(),
            ],
            [
                ProductType::productType => 'baby clothes',
                ProductType::companyTypeId => 1,
                ProductType::createdAt => Carbon::now(),
                ProductType::updatedAt => Carbon::now(),
            ]
        ]);
    }
}
