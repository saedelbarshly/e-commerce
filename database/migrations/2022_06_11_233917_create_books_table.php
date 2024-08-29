<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('name_ar');
            $table->text('name_en')->nullable();
            $table->text('name_fr')->nullable();
            $table->text('des_ar');
            $table->text('des_en')->nullable();
            $table->text('des_fr')->nullable();
            $table->integer('hardCopy')->default('0');
            $table->integer('pdfCopy')->default('0');
            $table->integer('available')->default('1');
            $table->text('full_des_ar')->nullable();
            $table->text('full_des_en')->nullable();
            $table->text('full_des_fr')->nullable();
            $table->text('index_ar')->nullable();
            $table->text('index_en')->nullable();
            $table->text('index_fr')->nullable();
            $table->string('price')->nullable();
            $table->string('offer')->nullable();
            $table->string('stock')->nullable();
            $table->text('photos')->nullable();
            $table->string('section_id')->nullable();
            $table->string('writer_id')->nullable();
            $table->string('publisher_id')->nullable();
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
        Schema::dropIfExists('books');
    }
}
