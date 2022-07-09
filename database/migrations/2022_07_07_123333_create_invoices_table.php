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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreignId('payment_safe_id')->references('id')->on('payment_safes')->onDelete('cascade');
            $table->foreignId('exchange_store_id')->references('id')->on('exchange_stores')->onDelete('cascade');
            $table->decimal('sub_total', 9, 3);
            $table->enum('discount_sort', ['نسبة', 'مبلغ']);
            $table->decimal('discount', 9, 3);
            $table->decimal('total', 9, 3);
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
        Schema::dropIfExists('invoices');
    }
};
