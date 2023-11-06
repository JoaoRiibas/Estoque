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
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('lote_id');
            $table->dateTime('validade_produto');
            $table->boolean('operacao');
            $table->text('local_armazenamento');
            $table->integer('qtd_produto');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('lote_id')->references('id')->on('lotes')->onDelete('cascade');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
