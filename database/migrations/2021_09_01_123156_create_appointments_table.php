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
            $table->float('extra', 5,2)->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->boolean('done')->default('0');
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
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
