<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Evento\Entities\Evento;

class EventoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evento()
    {
        $evento = factory(Evento::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/evento/eventos', $evento
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_evento()
    {
        $evento = factory(Evento::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/evento/eventos'
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_show_evento()
    {
        $evento = factory(Evento::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/evento/eventos/'.$evento->id
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_update_evento()
    {
        $evento = factory(Evento::class)->create();
        $editedEvento = factory(Evento::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/evento/eventos/'.$evento->id,
            $editedEvento
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_evento()
    {
        $evento = factory(Evento::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/evento/eventos/'.$evento->id
         )->assertStatus(200);

        $id=$evento->id;
        $data=Evento::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
