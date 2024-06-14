<?php

namespace Database\Seeders\Product;

use App\Models\Product\Size;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(Size::table)->truncate();
        DB::statement("SET foreign_key_checks=1");

        DB::table(Size::table)->insert([
            [
                Size::size => 'S',
                Size::createdAt => Carbon::now(),
                Size::updatedAt => Carbon::now(),
            ],
            [
                Size::size => 'M',
                Size::createdAt => Carbon::now(),
                Size::updatedAt => Carbon::now(),
            ],
            [
                Size::size => 'L',
                Size::createdAt => Carbon::now(),
                Size::updatedAt => Carbon::now(),
            ],
            [
                Size::size => 'XL',
                Size::createdAt => Carbon::now(),
                Size::updatedAt => Carbon::now(),
            ],
            [
                Size::size => 'XXL',
                Size::createdAt => Carbon::now(),
                Size::updatedAt => Carbon::now(),
            ],]
        );
    }
}
