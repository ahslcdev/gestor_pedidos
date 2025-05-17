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
        Schema::create('produtos_variacoes', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();

            $table->string('nm_variacao', 255);
            $table->decimal('vl_variacao', 10, 4);
                
            $table->unsignedBigInteger('cd_estoque')->nullable()->unique();
            $table->foreign('cd_estoque')->references('id')->on('estoque')->onDelete('cascade');

            $table->unsignedBigInteger('cd_produto');
            $table->foreign('cd_produto')->references('id')->on('produtos')->onDelete('cascade');

            // $table->string('img')->nullable();
            // $table->json('images')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos_variacoes');
    }
};
