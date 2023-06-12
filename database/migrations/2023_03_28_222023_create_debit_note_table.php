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
            $table->bigInteger('result_vat')->nullable();
            $table->bigInteger('total_wht')->nullable();
            $table->bigInteger('result_wht')->nullable();
            $table->String('received_bank')->nullable();
            $table->bigInteger('bank_charge')->nullable();
            // miss
            $table->String('received_from')->nullable();
            $table->datetime('debit_note_date')->nullable();
            $table->bigInteger('total')->nullable();
            $table->boolean('is_dolar')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('debit_note');
    }
}
