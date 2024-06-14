<?php

use App\Models\Product\Product;
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
        Schema::create(Product::table, function (Blueprint $table) {
            $table->id();
            $table->boolean(Product::isSold)->default(false);
            $table->string(Product::price);
            $table->text(Product::description);
            $table->string(Product::title);
            $table->timestamp(Product::endDate)->nullable();
            $table->boolean(Product::active)->default(true);
            $table->unsignedBigInteger(Product::view)->default(0);
            $table->unsignedInteger(Product::percent)->nullable();
            $table->unsignedInteger(Product::amount)->default(10);
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
        Schema::dropIfExists(Product::table);
    }
};
