<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Produccion\Entities\Produccion;

class ProduccionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_produccion()
    {
        $produccion = factory(Produccion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/produccions', $produccion
        );

        $this->assertApiResponse($produccion);
    }

    /**
     * @test
     */
    public function test_read_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/produccions/'.$produccion->id
        );

        $this->assertApiResponse($produccion->toArray());
    }

    /**
     * @test
     */
    public function test_update_produccion()
    {
        $produccion = factory(Produccion::class)->create();
        $editedProduccion = factory(Produccion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/produccions/'.$produccion->id,
            $editedProduccion
        );

        $this->assertApiResponse($editedProduccion);
    }

    /**
     * @test
     */
    public function test_delete_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/produccions/'.$produccion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/produccions/'.$produccion->id
        );

        $this->response->assertStatus(404);
    }
}
