<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressBoatPivotTable extends Migration
{
    public function up()
    {
        Schema::create('address_boat', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id', 'boat_id_fk_6093624')->references('id')->on('boats')->onDelete('cascade');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id', 'address_id_fk_6093624')->references('id')->on('addresses')->onDelete('cascade');
        });
    }
}
