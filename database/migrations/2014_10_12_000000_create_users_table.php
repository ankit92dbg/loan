<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->bigInteger('phone');
            $table->integer('otp')->nullable();
            $table->string('device_id')->nullable();
            $table->string('father_name',20)->nullable();
            $table->string('dob',20)->nullable();
            $table->integer('gender')->comment = '0=male,1=female'; //0=male,1=female
            $table->integer('martial_status')->comment = '0=single,1=married,2=divorced'; //0=single,1=married,2=divorced
            $table->string('aadhar_no',20)->nullable();
            $table->string('aadhar_front')->nullable();
            $table->string('aadhar_back')->nullable();
            $table->string('pan_no',20)->nullable();
            $table->string('pan_front')->nullable();
            $table->string('live_image')->nullable();
            $table->string('bank_name',20)->nullable();
            $table->string('bank_account_no',20)->nullable();
            $table->string('bank_ifsc',20)->nullable();
            $table->integer('loan_purpose')->nullable()->comment = '0=renovation,1=education,2=married,3=personal';
            $table->integer('residential_status')->nullable()->comment = '0=self/owner,1=parental,2=rented';
            $table->string('permanent_address',255)->nullable();
            $table->string('company_name')->nullable();
            $table->string('salary')->nullable();
            $table->string('requested_amount',10)->nullable();
            $table->string('eligible_amount',10)->nullable();
            $table->string('loan_amount',10)->nullable();
            $table->string('payable_amount',10)->nullable();
            $table->string('interest_rate',10)->nullable();
            $table->string('processing_fee',10)->nullable();
            $table->string('gst',10)->nullable();
            $table->string('loan_duration',10)->nullable(); //in days
            $table->integer('loan_status')->nullable()->comment = '-1=requested,0=pending,1=approved,2=reject'; //0=pending,1=approved,2=reject
            $table->integer('profile_status')->nullable()->comment = '0=incomplete,1=complete'; //0=incomplete,1=complete

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
