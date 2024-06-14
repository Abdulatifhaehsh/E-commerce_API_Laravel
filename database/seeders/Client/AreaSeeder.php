<?php

namespace Database\Seeders\Client;

use App\Models\Client\Area;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(Area::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(Area::table)->insert([
            [
                Area::area => 'Al-Furqan',
                Area::cityId => 1,
                Area::createdAt => Carbon::now(),
                Area::updatedAt => Carbon::now(),
            ],
            [
                Area::area => 'Mocambo',
                Area::cityId => 1,
                Area::createdAt => Carbon::now(),
                Area::updatedAt => Carbon::now(),
            ],
            [
                Area::area => 'almuhafaza',
                Area::cityId => 1,
                Area::createdAt => Carbon::now(),
                Area::updatedAt => Carbon::now(),
            ],
            [
                Area::area => 'sayf aldawla',
                Area::cityId => 1,
                Area::createdAt => Carbon::now(),
                Area::updatedAt => Carbon::now(),
            ]

        ]);
    }
}
