<?php

use App\Models\Product\Product;
use App\Models\Product\ProductImage;
use App\Models\Product\ProductSpecificationType;
use App\Models\Product\ProductType;
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
        Schema::table(Product::table, function(Blueprint $table){
            $table->foreignId(Product::userId)->constrained();
            $table->foreignId(Product::areaId)->constrained();
            $table->foreignId(Product::productTypeId)->constrained();
        });

        Schema::table(ProductType::table, function(Blueprint $table){
            $table->foreignId(ProductType::companyTypeId)->constrained();
        });

        Schema::table(SpecificationType::table, function(Blueprint $table){
            $table->foreignId(SpecificationType::companyTypeId)->constrained();
        });

        Schema::table(ProductImage::table, function(Blueprint $table){
            $table->foreignId(ProductImage::productId)->constrained();
        });

        Schema::table(ProductSpecificationType::table, function(Blueprint $table){
            $table->foreignId(ProductSpecificationType::productId)->constrained(Product::table, 'id');
            $table->foreignId(ProductSpecificationType::specificationTypeId)->constrained(SpecificationType::table, 'id');
        });

        Schema::table('products_sizes', function(Blueprint $table){
            $table->foreignId('product_id')->constrained();
            $table->foreignId('size_id')->constrained();
        });

        Schema::table('colors_products', function(Blueprint $table){
            $table->foreignId('product_id')->constrained();
            $table->foreignId('color_id')->constrained();
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
