<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Info extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('wattage'); //công suất
            $table->string('control'); //công suất
            $table->string('size'); //kích thước
            $table->string('utilities'); //tiện ích
            $table->string('trademark'); //nhãn hiệu
            $table->string('produce'); //sản xuất
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
}
