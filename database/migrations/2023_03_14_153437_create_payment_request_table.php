<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_request', function (Blueprint $table) {
            $table->id();
            $table->datetime('invoice_date')->nullable();
            $table->datetime('received_date')->nullable();
            $table->string('contract')->nullable();
            $table->datetime('date_pr')->nullable();
            $table->bigInteger('no_pr')->default(0);
            $table->unsignedBigInteger('id_division');
            $table->string('for')->nullable();
            $table->bigInteger('due_date')->default(0);
            $table->bigInteger('bank_charge')->default(0);
            $table->enum('currency', ['idr', 'usd', 'sgd'])->default('idr');
            $table->integer('vat')->default(0);
            $table->unsignedBigInteger('wht_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->enum('status', ['pending', 'reject', 'processing', 'paid'])->default('pending');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('wht_id')->references('id')->on('whts')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('id_division')->references('id')->on('division')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('bank_id')->references('id')->on('banks')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('vendor_id')->references('id')->on('vendors')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_request');
    }
}
