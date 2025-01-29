<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // id da tabela
            $table->string('name'); // nome do fornecedor
            $table->string('identifier')->unique(); // identificador único do fornecedor (ex: CNPJ ou CPF)
            $table->string('contact'); // campo de contato do fornecedor (telefone, email, etc.)
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
};
