<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherPaymentsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_payments_histories', function (Blueprint $table) {
            $table->id();
            $table->text('user_id');
            $table->text('payment_method_id');
            $table->text('account_holder_name');
            $table->text('account_number');
            $table->text('account_iban')->nullable();
            $table->text('account_swift_code')->nullable();
            $table->text('amount');
            $table->text('transaction_id');
            $table->text('from_details')->nullable();
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
        Schema::dropIfExists('publisher_payments_histories');
    }
}
