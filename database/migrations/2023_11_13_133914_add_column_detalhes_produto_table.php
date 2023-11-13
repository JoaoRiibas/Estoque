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
        Schema::table('produtos', function(Blueprint $table) {
            $table->string('descricao')->nullable();
            $table->string('unidade_medida')->nullable();
            $table->double('vl_custo')->nullable();
            $table->double('vl_venda')->nullable();
            $table->text('info_nutricional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function($table){
            $table->dropColumn('descricao');
            $table->dropColumn('unidade_medida');
            $table->dropColumn('vl_custo');
            $table->dropColumn('vl_venda');
            $table->dropColumn('info_nutricional');
        });
    }
};
