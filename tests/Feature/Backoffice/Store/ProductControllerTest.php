<?php


namespace Tests\Feature\Backoffice\Store;


use App\Models\Authentication\User;
use App\Repositories\Backoffice\Store\ProductRepository;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    private $repository;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->repository = app()->make(ProductRepository::class);
    }

    public function testGetSuccess()
    {
        Passport::actingAs(factory(User::class)->create(), ['*']);
        $this->testCreateSuccess();
        $request = $this->json('GET', $this->getUri() . '/backoffice/store/products');
        $request->assertStatus(200);
        $products = collect(json_decode($request->getContent())->data);
        $this->assertTrue($products->isNotEmpty());
    }

    public function testGetFilteredFind()
    {
        Passport::actingAs(factory(User::class)->create(), ['*']);
        $name = $this->faker->name;
        $this->testCreateSuccess(['name' => $name]);
        $request = $this->json('GET', $this->getUri() . '/backoffice/store/products', ['name' => $name]);
        $request->assertStatus(200);
        $products = collect(json_decode($request->getContent())->data);
        $this->assertTrue($products->count() === 1);
    }

    public function testGetFilteredNotFind()
    {
        Passport::actingAs(factory(User::class)->create(), ['*']);
        $this->testCreateSuccess();
        $request = $this->json('GET', $this->getUri() . '/backoffice/store/products', ['name' => 'asdasdasdasd']);
        $request->assertStatus(200);
        $products = collect(json_decode($request->getContent())->data);
        $this->assertTrue($products->isEmpty());
    }

    public function testCreateSuccess(array $abstractProduct = [])
    {
        Passport::actingAs(factory(User::class)->create(), ['*']);
        $product    = array_merge([
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text($this->faker->numberBetween(50, 499)),
            'category' => $this->faker->word,
            'price' => $this->faker->numberBetween(1000, 25000),
            'stock_amount' => $this->faker->numberBetween(0, 13)
        ], $abstractProduct);
        $request = $this->json('POST', $this->getUri() . '/backoffice/store/products', $product);
        $request->assertStatus(200);
        $this->assertDatabaseHas('products', $product);
    }

    public function testUpdateSuccess()
    {
        Passport::actingAs(factory(User::class)->create(), ['*']);
        $this->testCreateSuccess();
        $product    = [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->text($this->faker->numberBetween(50, 499)),
            'category' => $this->faker->word,
            'price' => $this->faker->numberBetween(1000, 25000),
            'stock_amount' => $this->faker->numberBetween(0, 13)
        ];
        $request = $this->json('PUT', $this->getUri() . '/backoffice/store/products/' . $this->repository->getLastProductCreated()->getUUID(), $product);
        $request->assertStatus(200);
        $this->assertDatabaseMissing('products', ['uuid' => $product]);
    }

    public function testDeleteSuccess()
    {
        Passport::actingAs(factory(User::class)->create(), ['*']);
        $this->testCreateSuccess();
        $product = $this->repository->getLastProductCreated();
        $request = $this->json('DELETE', $this->getUri() . '/backoffice/store/products/' . $product->getUUID());
        $request->assertStatus(200);
        $this->assertDatabaseMissing('products', ['uuid' => $product->getUUID()]);
    }
}
