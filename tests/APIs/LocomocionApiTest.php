<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Locomocion\Entities\Locomocion;

class LocomocionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_locomocion()
    {
        $locomocion = factory(Locomocion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/locomocion/locomociones', $locomocion
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_list_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/locomocion/locomociones'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/locomocion/locomociones/'.$locomocion->id
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_update_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();
        $editedLocomocion = factory(Locomocion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/locomocion/locomociones/'.$locomocion->id,
            $editedLocomocion
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/locomocion/locomociones/'.$locomocion->id
         )->assertStatus(200);

        $id=$locomocion->id;
        $data=Locomocion::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);

    }
}
