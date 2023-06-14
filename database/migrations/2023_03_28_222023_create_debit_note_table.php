<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debit_note', function (Blueprint $table) {
            $table->id();
            $table->String('no_invoice')->nullable();
            $table->datetime('invoice_date')->nullable();
            $table->string('tax_invoice_serial_no')->nullable();
            $table->datetime('tax_invoice_date')->nullable();
            $table->integer('no_debit_note')->default(0);
            $table->unsignedBigInteger('id_division');
            $table->string('for')->nullable();
            $table->bigInteger('bank_charge')->default(0);
            $table->String('received_from')->nullable();
            $table->datetime('debit_note_date')->nullable();
            $table->enum('currency', ['idr', 'usd', 'sgd'])->default('idr');
            $table->integer('vat')->default(0);
            $table->unsignedBigInteger('wht_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->timestamps();
            $table->foreign('id_division')->references('id')->on('division')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('wht_id')->references('id')->on('whts')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('debit_note');
    }
}
