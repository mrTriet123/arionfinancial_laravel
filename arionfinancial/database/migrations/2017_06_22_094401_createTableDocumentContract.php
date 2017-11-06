<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumentContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();            
            $table->string('cash_price');
            $table->string('description');
            $table->string('cost_rental');
            $table->string('tax_rate');
            $table->string('fname');
            $table->string('mname');
            $table->string('mailling');
            $table->string('p_phone');
            $table->string('email');
            $table->string('num_pay');
            $table->date('fpay');
            $table->string('lname');
            $table->string('apt');
            $table->string('zipcode');
            $table->string('add_phone');
            $table->date('birthday');
            $table->string('init_payment');
            $table->string('term_of_pay');
            $table->string('payment_amount');
            $table->string('file_name');
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
        Schema::dropIfExists('document_contracts');
    }
}
