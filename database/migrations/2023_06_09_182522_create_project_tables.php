<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('clientes')) {
            Schema::create('clientes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('telefone', 11);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at');
            });
        }
        

        if (!Schema::hasTable('restaurantes')) {
            Schema::create('restaurantes', function (Blueprint $table) {
                $table->id();
                $table->string('nome', 30);
                $table->string('nome_restaurante', 30)->unique();
                $table->time('hora_abertura');
                $table->time('hora_fechamento');
                $table->text('descricao');
                $table->string('telefone', 11);
                $table->string('email', 50)->unique();
                $table->string('senha');
                $table->text('imagem');
                $table->string('cep', 8);
                $table->string('rua', 60);
                $table->integer('numero');
                $table->string('complemento', 40);
                $table->string('ponto_referencia', 100);
                $table->string('estado', 2);
                $table->string('cidade', 100);
                $table->enum('especialidade', [
                    'Açaí',
                    'Africana',
                    'Arabe',
                    'Alemã',
                    'Argentina',
                    'Bebidas',
                    'Brasileira',
                    'Cafeteria',
                    'Carnes',
                    'Chinesa',
                    'Congelados',
                    'Colombiana',
                    'Coreana',
                    'Doces e bolos',
                    'Espanhola',
                    'Francesa',
                    'Peixes',
                    'Marmita',
                    'Mexicana',
                    'Salgados',
                    'Saudavel',
                    'Sorvete',
                    'Lanches',
                    'Sucos'
                ]);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at');
            });
        }

        if (!Schema::hasTable('enderecoClientes')) {
            Schema::create('enderecoClientes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cliente_id');
                $table->string('cep', 8);
                $table->string('rua', 60);
                $table->integer('numero');
                $table->string('complemento', 40);
                $table->string('ponto_referencia', 100);
                $table->string('estado', 2);
                $table->string('cidade', 100);
                $table->string('nome_identificador', 40);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at');

                $table->foreign('cliente_id')->references('id')->on('clientes');
            });
        }

        if (!Schema::hasTable('pedidos')) {
            Schema::create('pedidos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cliente_id');
                $table->unsignedBigInteger('endereco_cliente_id');
                $table->float('valor', 10, 2);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at');

                $table->foreign('cliente_id')->references('id')->on('clientes');
                $table->foreign('endereco_cliente_id')->references('id')->on('enderecoClientes');
            });
        }

        if (!Schema::hasTable('pratos')) {
            Schema::create('pratos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('restaurante_id');
                $table->text('descricao');
                $table->string('nome', 30);
                $table->text('imagem');
                $table->float('valor', 10, 2);
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at');

                $table->foreign('restaurante_id')->references('id')->on('restaurantes');
            });
        }

        if (!Schema::hasTable('pedidoItens')) {
            Schema::create('pedidoItens', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('pedido_id');
                $table->unsignedBigInteger('prato_id');
                $table->integer('quantidade');
                $table->timestamps();
                $table->softDeletes($column = 'deleted_at');

                $table->foreign('pedido_id')->references('id')->on('pedidos');
                $table->foreign('prato_id')->references('id')->on('pratos');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidoItens');
        Schema::dropIfExists('pratos');
        Schema::dropIfExists('pedidos');
        Schema::dropIfExists('enderecoClientes');
        Schema::dropIfExists('restaurantes');
        Schema::dropIfExists('clientes');
    }
};
