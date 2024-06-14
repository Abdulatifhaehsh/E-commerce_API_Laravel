<?php

use App\Models\Client\Area;
use App\Models\Client\City;
use App\Models\Client\Company;
use App\Models\Client\CompanyBranch;
use App\Models\Client\Wallet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Company::table, function (Blueprint $table) {
            $table->foreignId(Company::userId)->constrained();
            $table->foreignId(Company::companyTypeId)->constrained();
        });

        Schema::table(CompanyBranch::table, function (Blueprint $table) {
            $table->foreignId(CompanyBranch::companyId)->constrained();
            $table->foreignId(CompanyBranch::areaId)->constrained();

        });

        Schema::table(City::table, function (Blueprint $table) {
            $table->foreignId(City::countryId)->constrained();
        });

        Schema::table(Area::table, function(Blueprint $table) {
            $table->foreignId(Area::cityId)->constrained();
        });

        Schema::table(Wallet::table, function(Blueprint $table) {
            $table->foreignId(Wallet::userId)->constrained();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
