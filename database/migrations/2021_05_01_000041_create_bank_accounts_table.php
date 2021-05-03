<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('bank_name')->nullable();
            $table->string('beneficiary')->nullable();
            $table->string('account_number');
            $table->string('swift_code')->nullable();
            $table->string('tlx_number')->nullable();
            $table->longText('default_comment_on_tnx')->nullable();
            $table->longText('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
