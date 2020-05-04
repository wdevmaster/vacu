<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\TipoServicio\Entities\TipoServicio;

class TipoServicioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipo_servicios', $tipoServicio
        );

        $this->assertApiResponse($tipoServicio);
    }

    /**
     * @test
     */
    public function test_read_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tipo_servicios/'.$tipoServicio->id
        );

        $this->assertApiResponse($tipoServicio->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();
        $editedTipoServicio = factory(TipoServicio::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipo_servicios/'.$tipoServicio->id,
            $editedTipoServicio
        );

        $this->assertApiResponse($editedTipoServicio);
    }

    /**
     * @test
     */
    public function test_delete_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipo_servicios/'.$tipoServicio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipo_servicios/'.$tipoServicio->id
        );

        $this->response->assertStatus(404);
    }
}
