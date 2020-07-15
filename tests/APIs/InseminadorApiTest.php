<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Inseminador\Entities\Inseminador;

class InseminadorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inseminador()
    {
        $inseminador = factory(Inseminador::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/inseminador/inseminadores', $inseminador
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_list_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/inseminador/inseminadores'
        )->assertStatus(200);
    }


    /**
     * @test
     */
    public function test_show_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/inseminador/inseminadores/'.$inseminador->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();
        $editedInseminador = factory(Inseminador::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/inseminador/inseminadores/'.$inseminador->id,
            $editedInseminador
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/inseminador/inseminadores/'.$inseminador->id
         )->assertStatus(200);

        $id=$inseminador->id;
        $data=Inseminador::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
