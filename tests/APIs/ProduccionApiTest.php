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
            '/api/v1/produccion/producciones', $produccion
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/produccion/producciones'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/produccion/producciones/'.$produccion->id
        )->assertStatus(200);
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
            '/api/v1/produccion/producciones/'.$produccion->id,
            $editedProduccion
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_produccion()
    {
        $produccion = factory(Produccion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/produccion/producciones/'.$produccion->id
         )->assertStatus(200);

        $id=$produccion->id;
        $data=Produccion::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
