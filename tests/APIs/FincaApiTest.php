<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Negocio\Entities\Negocio;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Finca\Entities\Finca;

class FincaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_finca()
    {


        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $finca = factory(Finca::class)->make()->toArray();
        $finca['negocio_id'] = $id_negocio;


        $this->response = $this->json(
            'POST',
            '/api/v1/finca/fincas', $finca
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_finca()
    {

        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $finca = factory(Finca::class)->make()->toArray();
        $finca['negocio_id'] = $id_negocio;
        $result=factory(Finca::class)->create($finca);


        $this->response = $this->json(
            'GET',
            '/api/v1/finca/fincas'
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_show_finca()
    {

        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $finca = factory(Finca::class)->make()->toArray();
        $finca['negocio_id'] = $id_negocio;
        $result=factory(Finca::class)->create($finca);


        $this->response = $this->json(
            'GET',
            '/api/v1/finca/fincas/'.$result->id
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_update_finca()
    {
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $finca = factory(Finca::class)->make()->toArray();
        $finca['negocio_id'] = $id_negocio;
        $result=factory(Finca::class)->create($finca);
        $editedFinca = factory(Finca::class)->make()->toArray();
        $editedFinca['negocio_id'] = $id_negocio;

        $this->response = $this->json(
            'PUT',
            '/api/v1/finca/fincas/'.$result->id,
            $editedFinca
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_finca()
    {
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $finca = factory(Finca::class)->make()->toArray();
        $finca['negocio_id'] = $id_negocio;
        $result=factory(Finca::class)->create($finca);


        $this->response = $this->json(
            'DELETE',
             '/api/v1/finca/fincas/'.$result->id
         )->assertStatus(200);

        $id=$result->id;
        $data=Finca::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
