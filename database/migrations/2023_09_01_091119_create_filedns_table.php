<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilednsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filedns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('debit_id');
            $table->timestamps();
            $table->foreign('debit_id')->references('id')->on('debit_note')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filedns');
    }
}
