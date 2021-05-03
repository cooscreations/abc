<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_short_code')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_email')->nullable();
            $table->string('formal_reg_name')->nullable();
            $table->string('local_name')->nullable();
            $table->date('company_reg_date')->nullable();
            $table->boolean('has_english_speaking_staff')->default(0)->nullable();
            $table->string('company_reg_num')->nullable();
            $table->date('company_reg_expiry')->nullable();
            $table->string('export_license_num')->nullable();
            $table->string('import_license_num')->nullable();
            $table->boolean('social_9001')->default(0)->nullable();
            $table->boolean('production_9001')->default(0)->nullable();
            $table->boolean('anti_slavery_policy')->default(0)->nullable();
            $table->boolean('bsci_certified')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
