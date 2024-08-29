<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->nullable()->nullOnDelete();
            $table->string('date_time');
            $table->string('date_time_str');
            $table->enum('status', ['pending', 'processing', 'completed','canceled'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('coupun_code')->nullable();
            $table->string('coupun_id')->nullable();
            $table->float('total')->default(0);
            $table->string('net_total');
            $table->string('shipping_price')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('tax')->nullable();
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
