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
            '/api/eventos', $evento
        );

        $this->assertApiResponse($evento);
    }

    /**
     * @test
     */
    public function test_read_evento()
    {
        $evento = factory(Evento::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/eventos/'.$evento->id
        );

        $this->assertApiResponse($evento->toArray());
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
            '/api/eventos/'.$evento->id,
            $editedEvento
        );

        $this->assertApiResponse($editedEvento);
    }

    /**
     * @test
     */
    public function test_delete_evento()
    {
        $evento = factory(Evento::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/eventos/'.$evento->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/eventos/'.$evento->id
        );

        $this->response->assertStatus(404);
    }
}
