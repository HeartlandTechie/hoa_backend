<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address')->nullable();
            $table->string('street_address')->nullable();
            $table->string('street_name')->nullable();
            $table->string('lot_number')->nullable();
            $table->boolean('rental_flag')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
