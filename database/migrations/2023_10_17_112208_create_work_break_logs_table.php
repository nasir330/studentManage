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
        Schema::create('work_break_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectId')->constrained('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('employeeId')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('breakType')->nullable();
            $table->string('breakTime')->nullable();
            $table->string('backTime')->nullable();
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
        Schema::dropIfExists('work_break_logs');
    }
};
