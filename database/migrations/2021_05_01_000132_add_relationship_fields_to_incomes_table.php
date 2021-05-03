<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncomesTable extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->unsignedBigInteger('income_category_id')->nullable();
            $table->foreign('income_category_id', 'income_category_fk_3751223')->references('id')->on('income_categories');
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->foreign('bank_account_id', 'bank_account_fk_3757460')->references('id')->on('bank_accounts');
            $table->unsignedBigInteger('exchange_rate_id')->nullable();
            $table->foreign('exchange_rate_id', 'exchange_rate_fk_3757462')->references('id')->on('currency_rates');
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id', 'currency_fk_3757463')->references('id')->on('currencies');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_3758708')->references('id')->on('orders');
        });
    }
}
