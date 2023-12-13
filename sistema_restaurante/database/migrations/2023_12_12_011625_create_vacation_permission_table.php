<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description')->nullable(); 
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('pending'); 
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->timestamps();
         
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacation_request');
    }
};
