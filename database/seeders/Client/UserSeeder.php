<?php

namespace Database\Seeders\Client;

use App\Models\Client\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table(User::table)->truncate();
        DB::statement("SET foreign_key_checks=1");
    }
}
