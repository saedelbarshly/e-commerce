<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherPaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->text('name');
            $table->text('account_holder_name');
            $table->text('account_number');
            $table->text('account_iban')->nullable();
            $table->text('account_swift_code')->nullable();
            $table->string('primary')->default('0');
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
        Schema::dropIfExists('publisher_payment_methods');
    }
}
