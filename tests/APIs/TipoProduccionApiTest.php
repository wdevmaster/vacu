<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\TipoProduccion;

class TipoProduccionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipo_produccions', $tipoProduccion
        );

        $this->assertApiResponse($tipoProduccion);
    }

    /**
     * @test
     */
    public function test_read_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tipo_produccions/'.$tipoProduccion->id
        );

        $this->assertApiResponse($tipoProduccion->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->create();
        $editedTipoProduccion = factory(TipoProduccion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipo_produccions/'.$tipoProduccion->id,
            $editedTipoProduccion
        );

        $this->assertApiResponse($editedTipoProduccion);
    }

    /**
     * @test
     */
    public function test_delete_tipo_produccion()
    {
        $tipoProduccion = factory(TipoProduccion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipo_produccions/'.$tipoProduccion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipo_produccions/'.$tipoProduccion->id
        );

        $this->response->assertStatus(404);
    }
}
