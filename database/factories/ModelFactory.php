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
        'categoria_id' => $faker->numberBetween(1, 20),
        'preco' => $faker->randomFloat(2, 0, 1000000),
    ];
});

$factory->define(App\Pessoa::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'telefone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'tipo_id' => $faker->numberBetween(1, 2)
    ];
});

$factory->define(App\FiadoPessoa::class, function (Faker\Generator $faker) {
    return [
        'pessoa_id' => function () {
            return factory(App\Pessoa::class)->create()->id;
        },
        'total' => $faker->randomFloat(2, 0, 1000000),
    ];
});

$factory->define(App\FinanceiroCategoria::class, function (Faker\Generator $faker) {
    return [
        'centro_id' => function () {
            return factory(App\FinanceiroCentro::class)->create()->id;
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
        'data' => $faker->dateTime(),

        'fluxo' => $faker->numberBetween(1, 2),
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
        'pessoa_id' => function () {
            return factory(App\Pessoa::class)->create()->id;
        },
        'pagamento' => $faker->date(),
        'total' => $faker->randomFloat(2, 0, 1000000),
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
        'pessoa_id' => function () {
            return factory(App\Pessoa::class)->create()->id;
        },
        'total' => $faker->randomFloat(2, 0, 1000000),
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
        'preco' => $faker->randomFloat(2, 0, 1000000),
        'quantidade' => $faker->randomNumber(),
        'total' => $faker->randomFloat(2, 0, 1000000),
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
        'pessoa_id' => function () {
            return factory(App\Pessoa::class)->create()->id;
        },
        'pagamento' => $faker->date(),
        'total' => $faker->randomFloat(2, 0, 1000000),
    ];
});

$factory->define(App\Venda::class, function (Faker\Generator $faker) {
    return [
        'fiado' => $faker->boolean,
        'pessoa_id' => function () {
            return factory(App\Pessoa::class)->create()->id;
        },
        'forma_id' => $faker->numberBetween(1, 3),
        'total' => $faker->randomFloat(2, 0, 1000000),
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
        'preco' => $faker->randomFloat(2, 0, 1000000),
        'quantidade' => $faker->randomNumber(),
        'total' => $faker->randomFloat(2, 0, 1000000),
    ];
});

