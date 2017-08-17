<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\Auth\User\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\ProdutoCategoria::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
    ];
});

$factory->define(App\Produto::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'complemento' => $faker->word,
        'categoria_id' => $faker->randomNumber(),
    ];
});

$factory->define(App\Cliente::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
    ];
});

$factory->define(App\FiadoCliente::class, function (Faker\Generator $faker) {
    return [
        'cliente_id' => function () {
            return factory(App\Client::class)->create()->id;
        },
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\FinanceiroCategoria::class, function (Faker\Generator $faker) {
    return [
        'centro_id' => function () {
            return factory(App\FinancialCentre::class)->create()->id;
        },
        'nome' => $faker->name,
        'fluxo' => $faker->randomNumber(),
    ];
});

$factory->define(App\FinanceiroCentro::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
    ];
});

$factory->define(App\Movimento::class, function (Faker\Generator $faker) {
    return [
        'obs' => $faker->text,
    ];
});

$factory->define(App\MovimentoProduto::class, function (Faker\Generator $faker) {
    return [
        'produto_id' => function () {
            return factory(App\Produto::class)->create()->id;
        },
        'amount' => $faker->randomNumber(),
        'fluxo' => $faker->randomNumber(),
        'movimento_id' => function () {
            return factory(App\Movement::class)->create()->id;
        },
    ];
});

$factory->define(App\Pagamento::class, function (Faker\Generator $faker) {
    return [
        'compra_id' => function () {
            return factory(App\Compra::class)->create()->id;
        },
        'categoria_id' => function () {
            return factory(App\FinanceiroCategoria::class)->create()->id;
        },
        'fornecedor_id' => function () {
            return factory(App\Fornecedor::class)->create()->id;
        },
        'pagamento' => $faker->date(),
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\EstoqueProduto::class, function (Faker\Generator $faker) {
    return [
        'produto_id' => function () {
            return factory(App\Produto::class)->create()->id;
        },
        'movimento_entrada' => $faker->randomNumber(),
        'movimento_saida' => $faker->randomNumber(),
        'venda' => $faker->randomNumber(),
        'total' => $faker->randomNumber(),
    ];
});

$factory->define(App\Compra::class, function (Faker\Generator $faker) {
    return [
        'fornecedor_id' => function () {
            return factory(App\Fornecedor::class)->create()->id;
        },
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\CompraProduto::class, function (Faker\Generator $faker) {
    return [
        'compra_id' => function () {
            return factory(App\Compra::class)->create()->id;
        },
        'produto_id' => function () {
            return factory(App\Produto::class)->create()->id;
        },
        'preco' => $faker->randomFloat(2,0,1000000),
        'quantidade' => $faker->randomNumber(),
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\Recebimento::class, function (Faker\Generator $faker) {
    return [
        'venda_id' => function () {
            return factory(App\Venda::class)->create()->id;
        },
        'categoria_id' => function () {
            return factory(App\FinanceiroCategoria::class)->create()->id;
        },
        'cliente_id' => function () {
            return factory(App\Cliente::class)->create()->id;
        },
        'pagamento' => $faker->date(),
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\Venda::class, function (Faker\Generator $faker) {
    return [
        'fiado' => $faker->boolean,
        'cliente_id' => function () {
            return factory(App\Cliente::class)->create()->id;
        },
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\VendaProduto::class, function (Faker\Generator $faker) {
    return [
        'venda_id' => function () {
            return factory(App\Venda::class)->create()->id;
        },
        'produto_id' => function () {
            return factory(App\Produto::class)->create()->id;
        },
        'preco' => $faker->randomFloat(2,0,1000000),
        'quantidade' => $faker->randomNumber(),
        'total' => $faker->randomFloat(2,0,1000000),
    ];
});

$factory->define(App\Fornecedor::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'identificador' => $faker->word,
        'cep' => $faker->word,
        'rua' => $faker->streetName,
        'numero' => $faker->randomNumber(),
        'bairro' => $faker->word,
        'cidade' => $faker->city,
        'estado' => $faker->word,
    ];
});

