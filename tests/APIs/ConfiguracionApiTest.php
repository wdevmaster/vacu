<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Configuracion\Entities\Configuracion;

class ConfiguracionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_configuracion()
    {
        $configuracion = factory(Configuracion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/configuracion/configuraciones', $configuracion
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_configuracion()
    {
        $configuracion = factory(Configuracion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/configuracion/configuraciones'
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_update_configuracion()
    {
        $configuracion = factory(Configuracion::class)->create();
        $editedConfiguracion = factory(Configuracion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/configuracion/configuraciones/'.$configuracion->id,
            $editedConfiguracion
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_configuracion()
    {
        $configuracion = factory(Configuracion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/configuracion/configuraciones/'.$configuracion->id
         )->assertStatus(200);

        $id=$configuracion->id;
        $data=Configuracion::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
