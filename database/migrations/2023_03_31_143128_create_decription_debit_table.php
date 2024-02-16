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
            $table->decimal('price', 15, 2)->default(0);
            // $table->bigInteger('price')->default(0);
            $table->enum('type', ['reg', 'add'])->default('reg');
            $table->unsignedBigInteger('id_debit_note');
            $table->unsignedBigInteger('vat_id')->nullable();
            $table->unsignedBigInteger('wht_id')->nullable();
            $table->string('pr_serial')->nullable();
            $table->date('tax_date')->nullable();
            $table->timestamps();
            $table->foreign('id_debit_note')->references('id')->on('debit_note')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('vat_id')->references('id')->on('vats')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('wht_id')->references('id')->on('whts')->cascadeOnUpdate()->nullOnDelete();
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
