<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinuteDatasTable extends Migration
{
    public function up()
    {
        Schema::create('minute_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('year_created')->nullable();
            $table->longText('pdf_text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
