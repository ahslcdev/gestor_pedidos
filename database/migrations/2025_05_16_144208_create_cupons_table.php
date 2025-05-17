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
        Schema::create('cupons', function (Blueprint $table) {
            $table->id();

            $table->string('ds_codigo')->unique();
            $table->decimal('vl_desconto', 10, 2);
            $table->integer('nr_quantidade_disponivel')->default(1);
            $table->integer('nr_quantidade_usos')->default(0);

            $table->date('dt_inicio')->nullable();
            $table->date('dt_fim')->nullable();

            $table->boolean('ie_ativo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};
