<?php

use App\Models\Product\CompanyType;
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
        Schema::create(CompanyType::table, function (Blueprint $table) {
            $table->id();
            $table->string(CompanyType::companyType);
            $table->string(CompanyType::companyTypeIcon)->nullable();
            $table->boolean(CompanyType::isSize)->default(false);
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
        Schema::dropIfExists(CompanyType::table);
    }
};
