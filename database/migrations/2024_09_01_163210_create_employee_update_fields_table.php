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
        Schema::create('employee_update_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->unsigned()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('logId')->nullable();           
            $table->string('firstName')->nullable();           
            $table->string('lastName')->nullable();                 
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('phone1')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_update_fields');
    }
};
