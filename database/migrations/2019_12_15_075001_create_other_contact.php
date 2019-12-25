<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_contact', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('family_type',20)->nullable()->comment = '0=father,1=mother,2=brother,3=sister,4=friend,5=other';
            $table->string('name',20)->nullable();
            $table->string('phone_number',20)->nullable();
            //$table->integer('type')->nullable()->comment = '0=family,1=reference';//0=family,1=reference
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
        Schema::dropIfExists('other_contact');
    }
}
