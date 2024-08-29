<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('description_ar');
            $table->string('description_en');
            $table->string('metadata_ar');
            $table->string('metadata_en');
            $table->string('keywords_ar')->nullable();
            $table->string('keywords_en')->nullable();
            $table->string('type');
            $table->string('price');
            $table->boolean('status')->default(1);
            $table->integer('ordering')->default(0);
            $table->integer('quantity');
            $table->integer('min_quantity')->nullable();
            $table->enum('unavailableProductStatus', ['available', 'unavailable', 'Pre-booking', 'availableAfterTwoDays'])->default('available');
            $table->enum('dimensions', ['length','width', 'height']);
            $table->boolean('discountFromAvailableProducts')->nullable();
            $table->boolean('shipping')->default(1);
            $table->string('weight')->nullable();
            $table->string('availableProductsDate')->nullable();
            $table->string('relatedProducts')->nullable();
            $table->foreignId('tax_type_id')->constrained('tax_types')->nullOnDelete();
            $table->foreignId('category_id')->constrained('categories')->nullOnDelete();;
            $table->foreignId('company_id')->constrained('companies')->nullOnDelete();;
            $table->foreignId('length_id')->constrained('lengths')->nullOnDelete();;
            $table->foreignId('weights_id')->constrained('weights')->nullOnDelete();;
            $table->foreignId('product_specification_id')->constrained('product_specifications')->nullOnDelete();;
            $table->foreignId('option_type_id')->constrained('option_types')->nullOnDelete();;
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
    }
};
