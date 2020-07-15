<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Ingreso\Entities\Ingreso;

class IngresoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ingreso()
    {
        $ingreso = factory(Ingreso::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/ingreso/ingresos', $ingreso
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/ingreso/ingresos/'.$ingreso->id
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_show_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/ingreso/ingresos/'.$ingreso->id
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_update_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();
        $editedIngreso = factory(Ingreso::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/ingreso/ingresos/'.$ingreso->id,
            $editedIngreso
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/ingreso/ingresos/'.$ingreso->id
         )->assertStatus(200);

        $id=$ingreso->id;
        $data=Ingreso::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
