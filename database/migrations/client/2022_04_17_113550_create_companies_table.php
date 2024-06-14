<?php

use App\Models\Client\Company;
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
        Schema::create(Company::table, function (Blueprint $table) {
            $table->id();
            $table->string(Company::name);
            $table->string(Company::logo);
            $table->string(Company::mobile);
            $table->string(Company::facadeUrl);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Company::table);
    }
};
