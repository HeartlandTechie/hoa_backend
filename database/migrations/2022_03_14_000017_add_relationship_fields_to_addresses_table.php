<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('rental_owner_id')->nullable();
            $table->foreign('rental_owner_id', 'rental_owner_fk_6185925')->references('id')->on('users');
        });
    }
}
