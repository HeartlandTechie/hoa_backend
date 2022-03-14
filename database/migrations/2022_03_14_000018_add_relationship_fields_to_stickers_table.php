<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStickersTable extends Migration
{
    public function up()
    {
        Schema::table('stickers', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id', 'address_fk_6093655')->references('id')->on('addresses');
            $table->unsignedBigInteger('boat_id')->nullable();
            $table->foreign('boat_id', 'boat_fk_6093628')->references('id')->on('boats');
        });
    }
}
