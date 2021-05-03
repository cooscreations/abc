<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExpensesTable extends Migration
{
    public function up()
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('expense_category_id')->nullable();
            $table->foreign('expense_category_id', 'expense_category_fk_3751215')->references('id')->on('expense_categories');
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->foreign('bank_account_id', 'bank_account_fk_3757456')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_3757457')->references('id')->on('currencies');
            $table->unsignedBigInteger('exchange_rate_id')->nullable();
            $table->foreign('exchange_rate_id', 'exchange_rate_fk_3757459')->references('id')->on('currency_rates');
        });
    }
}
