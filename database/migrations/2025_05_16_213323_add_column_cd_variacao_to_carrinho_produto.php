<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carrinho_produto', function (Blueprint $table) {
            $table->unsignedBigInteger('cd_variacao')->nullable();
            $table->foreign('cd_variacao')->references('id')->on('produtos_variacoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carrinho_produto', function (Blueprint $table) {
            $table->dropForeign(['cd_variacao']);
            $table->dropColumn('cd_variacao');
        });
    }
};
