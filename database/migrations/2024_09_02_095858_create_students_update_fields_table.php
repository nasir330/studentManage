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
        Schema::create('students_update_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->unsigned()->constrained('users')->onUpdate('cascade')->onDelete('cascade');           
            $table->string('logId')->nullable();
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('fathersName')->nullable();
            $table->string('mothersName')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('phone')->nullable();           
            $table->string('gurdianPhone')->nullable();
            $table->string('country')->nullable();
            $table->string('councilorComments')->nullable();
            $table->string('managerComment')->nullable();
            $table->string('academicQualification')->nullable();
            $table->string('epGroup')->nullable();
            $table->string('epScore')->nullable();
            $table->string('workExperience')->nullable();
            $table->string('paymentMethods')->nullable();
            $table->string('payAmount')->nullable();
            $table->string('paymentDescription')->nullable();
            $table->string('leadSource')->nullable();
            $table->string('accHolderName')->nullable();
            $table->string('accNumber')->nullable();
            $table->string('bankName')->nullable();
            $table->string('branch')->nullable();
            $table->string('branchCode')->nullable();
            $table->string('joinDate')->nullable();
            $table->string('leavingDate')->nullable();
            $table->string('currentDate')->nullable();
            $table->string('remindDate')->nullable();
            $table->string('followupFor')->nullable();
            $table->string('assignedTo')->nullable();
            $table->string('status')->nullable();
            $table->string('weightage')->nullable();           
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
        Schema::dropIfExists('students_update_fields');
    }
};
