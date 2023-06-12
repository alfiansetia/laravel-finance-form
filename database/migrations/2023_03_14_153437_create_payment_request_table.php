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
            $table->string('name_beneficiary')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('for')->nullable();
            $table->bigInteger('result_vat')->nullable();
            $table->bigInteger('total_wht')->nullable();
            $table->bigInteger('result_wht')->nullable();
            $table->String('beneficiary_bank')->nullable();
            $table->bigInteger('due_date')->nullable();
            $table->datetime('deadline')->nullable();
            $table->bigInteger('bank_charge')->nullable();
            $table->bigInteger('total')->nullable();
            $table->enum('currency', ['idr', 'usd', 'sgd'])->default('idr');
            $table->unsignedBigInteger('wht_id')->nullable();
            $table->timestamps();
            $table->foreign('wht_id')->references('id')->on('whts')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('id_division')->references('id')->on('division')->cascadeOnUpdate()->cascadeOnDelete();
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
