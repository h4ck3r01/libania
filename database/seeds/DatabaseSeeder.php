<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Pessoa::class, 20)->create();
        factory(App\ProdutoCategoria::class, 20)->create();
        factory(App\Produto::class, 20)->create();
        factory(App\Movimento::class, 20)->create();
    }
}
