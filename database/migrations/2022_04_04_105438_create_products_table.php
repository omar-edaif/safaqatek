<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 20);
            $table->string('name_ar', 20);
            $table->string('image')->nullable();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->constrained('product_categories');
            $table->string('name_en', 20);
            $table->string('name_ar', 20);
            $table->string('award_name_ar');
            $table->string('award_name_en');
            $table->string('image')->nullable();
            $table->string('award_image')->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->bigInteger('sold_number');
            $table->boolean('is_donate')->default(1);
            $table->timestamp('closing_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_categories');
    }
}
