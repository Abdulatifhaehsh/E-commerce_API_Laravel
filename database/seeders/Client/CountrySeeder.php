<?php

namespace Database\Seeders\Client;

use App\Models\Client\Country;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(Country::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(Country::table)->insert([
            [
                Country::country => 'Syria',
                Country::createdAt => Carbon::now(),
                Country::updatedAt => Carbon::now(),
            ]

        ]);
    }
}
