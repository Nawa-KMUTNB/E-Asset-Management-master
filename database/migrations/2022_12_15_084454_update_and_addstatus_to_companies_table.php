<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->renameColumn('name', 'num_asset');
            $table->string('name_asset');
            $table->renameColumn('email', 'propoty');
            $table->longText('detail');
            $table->renameColumn('address', 'unit');
            $table->date('date_into');
            $table->double('price', 10, 2);
            $table->string('place');
            $table->string("fullname");
            $table->string("department");
            $table->string("name_info");
            $table->integer("code_money");
            $table->string("name_money");
            $table->integer("budget");
            $table->string("status_buy");
            $table->string("status_sell");
            $table->string("num_old_asset");
            $table->string('num_department');
            $table->double('per_price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
        });
    }
};