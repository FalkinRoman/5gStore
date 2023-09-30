<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipsToProducts extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Внешний ключ и связь с таблицей subcategories (с возможностью null)
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->cascadeOnDelete();

            // Внешний ключ и связь с таблицей brands
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Удаляем внешние ключи
            $table->dropForeign(['subcategory_id']);
            $table->dropForeign(['brand_id']);
        });
    }
}
