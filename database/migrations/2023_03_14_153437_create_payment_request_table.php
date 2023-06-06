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
            $table->string('no_pr')->nullable();
            $table->foreignId('id_division')->nullable();
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
            $table->boolean('is_dolar')->nullable();
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
        Schema::dropIfExists('payment_request');
    }
}
