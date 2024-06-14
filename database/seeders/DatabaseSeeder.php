<?php

namespace Database\Seeders;

use Database\Seeders\Client\AreaSeeder;
use Database\Seeders\Client\CitySeeder;
use Database\Seeders\Client\CountrySeeder;
use Database\Seeders\Product\CompanyTypeSeeder;
use Database\Seeders\Product\ProductTypeSeeder;
use Database\Seeders\Product\SizeSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                CountrySeeder::class,
                CitySeeder::class,
                AreaSeeder::class,
                CompanyTypeSeeder::class,
                ProductTypeSeeder::class,
                SizeSeeder::class
            ]
        );
    }
}
