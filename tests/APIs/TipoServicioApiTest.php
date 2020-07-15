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
            '/api/v1/tipo_servicio/tipos_servicios', $tipoServicio
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/tipo_servicio/tipos_servicios'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/tipo_servicio/tipos_servicios/'.$tipoServicio->id
        )->assertStatus(200);
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
            '/api/v1/tipo_servicio/tipos_servicios/'.$tipoServicio->id,
            $editedTipoServicio
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_tipo_servicio()
    {
        $tipoServicio = factory(TipoServicio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/tipo_servicio/tipos_servicios/'.$tipoServicio->id
         )->assertStatus(200);

        $id=$tipoServicio->id;
        $data=TipoServicio::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
