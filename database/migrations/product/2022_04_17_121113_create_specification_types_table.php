<?php

use App\Models\Product\SpecificationType;
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
        Schema::create(SpecificationType::table, function (Blueprint $table) {
            $table->id();
            $table->string(SpecificationType::specificationsType);
            $table->string(SpecificationType::specificationsIcon)->nullable();
            $table->json(SpecificationType::values);
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
        Schema::dropIfExists(SpecificationType::table);
    }
};
