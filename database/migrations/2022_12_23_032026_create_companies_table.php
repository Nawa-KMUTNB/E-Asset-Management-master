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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('num_asset');
            $table->date('date_into');
            $table->string('name_asset');
            $table->longText('detail');
            $table->string('unit');
            $table->string('place');
            $table->double('per_price', 10, 2);
            $table->string("status_buy");
            $table->string("num_old_asset");
            $table->string('pic');
            $table->string("fullname");
            $table->string("department");
            $table->string("name_info");
            $table->string('num_department');
            $table->integer('code_money');
            $table->string('name_money');
            $table->integer('budget');
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
        Schema::dropIfExists('companies');
    }
};