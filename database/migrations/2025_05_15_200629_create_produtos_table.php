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
         Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nm_produto', 255);
            // $table->decimal('vl_produto', 6, 4);
            $table->text('ds_produto')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
                
            // $table->unsignedBigInteger('cd_estoque')->nullable()->unique();
            // $table->foreign('cd_estoque')->references('id')->on('estoque')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
