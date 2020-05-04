<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\EstadoFisico\Entities\EstadoFisico;

class EstadoFisicoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/estado_fisicos', $estadoFisico
        );

        $this->assertApiResponse($estadoFisico);
    }

    /**
     * @test
     */
    public function test_read_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/estado_fisicos/'.$estadoFisico->id
        );

        $this->assertApiResponse($estadoFisico->toArray());
    }

    /**
     * @test
     */
    public function test_update_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();
        $editedEstadoFisico = factory(EstadoFisico::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/estado_fisicos/'.$estadoFisico->id,
            $editedEstadoFisico
        );

        $this->assertApiResponse($editedEstadoFisico);
    }

    /**
     * @test
     */
    public function test_delete_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/estado_fisicos/'.$estadoFisico->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/estado_fisicos/'.$estadoFisico->id
        );

        $this->response->assertStatus(404);
    }
}
