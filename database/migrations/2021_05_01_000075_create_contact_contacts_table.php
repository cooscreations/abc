<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('local_name')->nullable();
            $table->string('wechat')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('personal_url')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('nda_signed_date')->nullable();
            $table->date('honesty_agreement_signed_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
