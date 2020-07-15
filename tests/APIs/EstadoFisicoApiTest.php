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
            '/api/v1/estado_fisico/estados_fisicos', $estadoFisico
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/estado_fisico/estados_fisicos'
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_show_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/estado_fisico/estados_fisicos/'.$estadoFisico->id
        )->assertStatus(200);
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
            '/api/v1/estado_fisico/estados_fisicos/'.$estadoFisico->id,
            $editedEstadoFisico
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_estado_fisico()
    {
        $estadoFisico = factory(EstadoFisico::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/estado_fisico/estados_fisicos/'.$estadoFisico->id
         );
        $id=$estadoFisico->id;
        $data=EstadoFisico::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);

    }
}
