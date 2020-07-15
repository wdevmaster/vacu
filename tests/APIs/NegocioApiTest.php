<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Negocio\Entities\Negocio;

class NegocioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_negocio()
    {
        $negocio = factory(Negocio::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/negocio/negocios', $negocio
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_negocio()
    {
        $negocio = factory(Negocio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/negocio/negocios'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_negocio()
    {
        $negocio = factory(Negocio::class)->create();
        $editedNegocio = factory(Negocio::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/negocio/negocios/'.$negocio->id,
            $editedNegocio
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_negocio()
    {
        $negocio = factory(Negocio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/negocio/negocios/'.$negocio->id
         )->assertStatus(200);

        $id=$negocio->id;
        $data=Negocio::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);

    }
}
