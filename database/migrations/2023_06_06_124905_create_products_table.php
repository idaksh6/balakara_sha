<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('student_image');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('academic_year');
            $table->string('grade');
            $table->string('language');
            $table->string('sibling_details')->nullable();
            $table->string('fathers_name');
            $table->string('fathers_qualification');
            $table->string('fathers_email_details');
            $table->string('fathers_contact_details');
            $table->string('fathers_occupation');
            $table->string('mothers_name');
            $table->string('mothers_qualification');
            $table->string('mothers_email_details');
            $table->string('mothers_contact_details');
            $table->string('mothers_occupation');
            $table->text('address');
            $table->string('payment_details');
            $table->string('category');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
