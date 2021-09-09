<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time');
            $table->string('comment')->nullable();
            $table->float('tot_paid', 5,2);
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**m
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) 
        {
            // Remove Relation
            $table->dropForeign('appointments_client_id_foreign');
            $table->dropForeign('appointments_employee_id_foreign');
        });
          
        Schema::dropIfExists('appointments');
    }
}
