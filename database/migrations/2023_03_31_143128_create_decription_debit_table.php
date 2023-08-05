<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecriptionDebitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decription_debit', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->bigInteger('price')->default(0);
            $table->enum('type', ['reg', 'add'])->default('reg');
            $table->unsignedBigInteger('id_debit_note');
            $table->timestamps();
            $table->foreign('id_debit_note')->references('id')->on('debit_note')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('decription_debit');
    }
}
