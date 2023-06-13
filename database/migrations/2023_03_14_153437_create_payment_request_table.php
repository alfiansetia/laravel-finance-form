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
            $table->bigInteger('result_vat')->default(0);
            $table->bigInteger('total_wht')->default(0);
            $table->bigInteger('result_wht')->default(0);
            $table->String('beneficiary_bank')->nullable();
            $table->bigInteger('due_date')->default(0);
            $table->datetime('deadline')->nullable();
            $table->bigInteger('bank_charge')->default(0);
            $table->bigInteger('total')->default(0);
            $table->enum('currency', ['idr', 'usd', 'sgd'])->default('idr');
            $table->enum('vat', ['yes', 'no'])->default('yes');
            $table->unsignedBigInteger('wht_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->timestamps();
            $table->foreign('wht_id')->references('id')->on('whts')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('id_division')->references('id')->on('division')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('bank_id')->references('id')->on('banks')->cascadeOnUpdate()->nullOnDelete();
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
