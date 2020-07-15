<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Lactancia\Entities\Lactancia;

class LactanciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_lactancia()
    {
        $lactancia = factory(Lactancia::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/lactancia/lactancias', $lactancia
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_list_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/lactancia/lactancias'
        )->assertStatus(200);

    }


    /**
     * @test
     */
    public function test_show_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/lactancia/lactancias/'.$lactancia->id
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_update_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();
        $editedLactancia = factory(Lactancia::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/lactancia/lactancias/'.$lactancia->id,
            $editedLactancia
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/lactancia/lactancias/'.$lactancia->id
         )->assertStatus(200);

        $id=$lactancia->id;
        $data=Lactancia::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
