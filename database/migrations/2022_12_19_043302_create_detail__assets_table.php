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
        Schema::create('detail__assets', function (Blueprint $table) {
            $table->id();
            $table->string("num_asset");
            $table->string("name_asset");
            $table->string("propoty");
            $table->longText("detail");
            $table->string("unit");
            $table->string("date_into");
            $table->double("price", 10, 2);
            $table->string("place");
            $table->string("name");
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
        Schema::dropIfExists('detail__assets');
    }
};