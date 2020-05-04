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
            '/api/negocios', $negocio
        );

        $this->assertApiResponse($negocio);
    }

    /**
     * @test
     */
    public function test_read_negocio()
    {
        $negocio = factory(Negocio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/negocios/'.$negocio->id
        );

        $this->assertApiResponse($negocio->toArray());
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
            '/api/negocios/'.$negocio->id,
            $editedNegocio
        );

        $this->assertApiResponse($editedNegocio);
    }

    /**
     * @test
     */
    public function test_delete_negocio()
    {
        $negocio = factory(Negocio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/negocios/'.$negocio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/negocios/'.$negocio->id
        );

        $this->response->assertStatus(404);
    }
}
