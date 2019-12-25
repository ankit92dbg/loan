<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('requested_amount',10)->nullable();
            $table->string('eligible_amount',10)->nullable();
            $table->string('loan_amount',10)->nullable();
            $table->integer('loan_purpose')->nullable()->comment = '0=renovation,1=education,2=married,3=personal';
            $table->string('payable_amount',10)->nullable();
            $table->string('interest_rate',10)->nullable();
            $table->string('processing_fee',10)->nullable();
            $table->string('gst',10)->nullable();
            $table->string('loan_duration',10)->nullable(); //in days
            $table->integer('loan_status')->nullable()->comment = '-1=requested,0=pending,1=approved,2=reject'; //0=pending,1=approved,2=reject
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
        Schema::dropIfExists('loan');
    }
}
