<?php

namespace Database\Seeders\Client;

use App\Models\Client\City;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(City::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(City::table)->insert([
            [
                City::city => 'Aleppo',
                City::countryId => 1,
                City::createdAt => Carbon::now(),
                City::updatedAt => Carbon::now(),
            ]

        ]);
    }
}
