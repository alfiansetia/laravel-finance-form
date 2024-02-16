<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->decimal('price', 15, 2)->default(0);
            // $table->bigInteger('price')->default(0);
            $table->enum('type', ['reg', 'add'])->default('reg');
            $table->unsignedBigInteger('id_payment_request');
            $table->unsignedBigInteger('vat_id')->nullable();
            $table->unsignedBigInteger('wht_id')->nullable();
            $table->string('pr_serial')->nullable();
            $table->date('tax_date')->nullable();
            $table->timestamps();
            $table->foreign('id_payment_request')->references('id')->on('payment_request')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('description');
    }
}
