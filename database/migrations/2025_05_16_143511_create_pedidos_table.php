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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('nm_cliente', 255);
            $table->string('ds_email_cliente', 255);
            $table->string('ds_cep', 9);
            $table->string('ds_logradouro', 255);
            $table->string('nr_endereco', 20);
            $table->string('ds_complemento')->nullable();
            $table->string('ds_bairro', 100);
            $table->string('ds_cidade', 100);
            $table->string('ds_estado', 2);
            
            $table->decimal('vl_total', 10, 4);
            $table->enum('ie_status_pedido', ['Pendente', 'Realizado', 'Cancelado', 'Entregue'])->default('Pendente');

            $table->unsignedBigInteger('cd_carrinho');
            $table->foreign('cd_carrinho')->references('id')->on('carrinho')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
