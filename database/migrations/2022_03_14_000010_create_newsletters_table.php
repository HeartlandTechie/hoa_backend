<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewslettersTable extends Migration
{
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->date('newsletter_date')->nullable();
            $table->boolean('display_flag')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
