<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\Animal;

class AnimalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_animal()
    {
        $animal = factory(Animal::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/animals', $animal
        );

        $this->assertApiResponse($animal);
    }

    /**
     * @test
     */
    public function test_read_animal()
    {
        $animal = factory(Animal::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/animals/'.$animal->id
        );

        $this->assertApiResponse($animal->toArray());
    }

    /**
     * @test
     */
    public function test_update_animal()
    {
        $animal = factory(Animal::class)->create();
        $editedAnimal = factory(Animal::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/animals/'.$animal->id,
            $editedAnimal
        );

        $this->assertApiResponse($editedAnimal);
    }

    /**
     * @test
     */
    public function test_delete_animal()
    {
        $animal = factory(Animal::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/animals/'.$animal->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/animals/'.$animal->id
        );

        $this->response->assertStatus(404);
    }
}
