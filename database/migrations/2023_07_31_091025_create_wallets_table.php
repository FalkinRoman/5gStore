<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Внешний ключ для связи с таблицей "users"
            $table->unsignedBigInteger('cryptocurrency_id'); // Внешний ключ для связи с таблицей "cryptocurrencies"
            $table->decimal('balance', 18, 8); // Предположим, что баланс хранится с точностью до 8 знаков после запятой
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cryptocurrency_id')->references('id')->on('cryptocurrencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
