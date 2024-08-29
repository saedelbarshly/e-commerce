<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_features', function (Blueprint $table) {
            $table->id();
            $table->text('name_ar');
            $table->text('name_en')->nullable();
            $table->text('name_fr')->nullable();
            $table->text('value_ar');
            $table->text('value_en')->nullable();
            $table->text('value_fr')->nullable();
            $table->string('book_id');
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
        Schema::dropIfExists('book_features');
    }
}
