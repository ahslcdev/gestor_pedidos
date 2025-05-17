<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Cupons
        DB::table('cupons')->insert([
            [
                'ds_codigo' => 'DESCONTO10',
                'vl_desconto' => 10.00,
                'nr_quantidade_disponivel' => 100,
                'nr_quantidade_usos' => 0,
                'dt_inicio' => Carbon::now()->subDays(10),
                'dt_fim' => Carbon::now()->addDays(20),
                'ie_ativo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ds_codigo' => 'PROMO20',
                'vl_desconto' => 20.00,
                'nr_quantidade_disponivel' => 50,
                'nr_quantidade_usos' => 0,
                'dt_inicio' => Carbon::now()->subDays(5),
                'dt_fim' => Carbon::now()->addDays(10),
                'ie_ativo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ds_codigo' => 'ESPECIAL15',
                'vl_desconto' => 15.00,
                'nr_quantidade_disponivel' => 200,
                'nr_quantidade_usos' => 0,
                'dt_inicio' => Carbon::now()->subDays(1),
                'dt_fim' => Carbon::now()->addDays(30),
                'ie_ativo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ds_codigo' => 'VERAO25',
                'vl_desconto' => 25.00,
                'nr_quantidade_disponivel' => 150,
                'nr_quantidade_usos' => 0,
                'dt_inicio' => Carbon::now()->subDays(3),
                'dt_fim' => Carbon::now()->addDays(15),
                'ie_ativo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ds_codigo' => 'FRETEGRATIS',
                'vl_desconto' => 0.00,
                'nr_quantidade_disponivel' => 300,
                'nr_quantidade_usos' => 0,
                'dt_inicio' => Carbon::now(),
                'dt_fim' => Carbon::now()->addDays(30),
                'ie_ativo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ds_codigo' => 'NATAL50',
                'vl_desconto' => 50.00,
                'nr_quantidade_disponivel' => 30,
                'nr_quantidade_usos' => 0,
                'dt_inicio' => Carbon::now()->subDays(1),
                'dt_fim' => Carbon::now()->addDays(60),
                'ie_ativo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Estoque
        DB::table('estoque')->insert([
            ['nr_quantidade' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['nr_quantidade' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['nr_quantidade' => 200, 'created_at' => now(), 'updated_at' => now()],
            ['nr_quantidade' => 75, 'created_at' => now(), 'updated_at' => now()],
            ['nr_quantidade' => 120, 'created_at' => now(), 'updated_at' => now()],
            ['nr_quantidade' => 90, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Produtos
        DB::table('produtos')->insert([
            [
                'nm_produto' => 'Camiseta Básica',
                'ds_produto' => 'Camiseta 100% algodão, várias cores',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produto' => 'Tênis Esportivo',
                'ds_produto' => 'Tênis confortável para corrida e academia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produto' => 'Mochila Casual',
                'ds_produto' => 'Mochila resistente com vários compartimentos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produto' => 'Relógio Digital',
                'ds_produto' => 'Relógio com display digital e várias funções',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produto' => 'Jaqueta Jeans',
                'ds_produto' => 'Jaqueta jeans estilosa para o dia a dia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_produto' => 'Fone de Ouvido Bluetooth',
                'ds_produto' => 'Fone sem fio com alta qualidade de som',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Produtos_variacoes
        DB::table('produtos_variacoes')->insert([
            [
                'nm_variacao' => 'Cor: Vermelho - Tamanho: M',
                'vl_variacao' => 39.90,
                'cd_estoque' => 1,
                'cd_produto' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_variacao' => 'Cor: Azul - Tamanho: G',
                'vl_variacao' => 42.90,
                'cd_estoque' => 2,
                'cd_produto' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_variacao' => 'Cor: Preto - Tamanho: Único',
                'vl_variacao' => 120.00,
                'cd_estoque' => 3,
                'cd_produto' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_variacao' => 'Modelo: Digital - Cor: Preto',
                'vl_variacao' => 199.90,
                'cd_estoque' => 4,
                'cd_produto' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_variacao' => 'Tamanho: M - Cor: Azul Claro',
                'vl_variacao' => 159.90,
                'cd_estoque' => 5, 
                'cd_produto' => 5, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nm_variacao' => 'Bluetooth 5.0 - Cor: Branco',
                'vl_variacao' => 249.90,
                'cd_estoque' => 6,
                'cd_produto' => 6, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
