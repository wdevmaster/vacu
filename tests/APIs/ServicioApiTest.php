<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Servicio\Entities\Servicio;

class ServicioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_servicio()
    {
        $servicio = factory(Servicio::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/servicio/servicios', $servicio
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_servicio()
    {
        $servicio = factory(Servicio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/servicio/servicios'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_servicio()
    {
        $servicio = factory(Servicio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/servicio/servicios/'.$servicio->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_servicio()
    {
        $servicio = factory(Servicio::class)->create();
        $editedServicio = factory(Servicio::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/servicio/servicios/'.$servicio->id,
            $editedServicio
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_servicio()
    {
        $servicio = factory(Servicio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/servicio/servicios/'.$servicio->id
         )->assertStatus(200);

        $id=$servicio->id;
        $data=Servicio::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
