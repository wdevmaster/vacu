<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\ClienteNegocio;

class ClienteNegocioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cliente_negocios', $clienteNegocio
        );

        $this->assertApiResponse($clienteNegocio);
    }

    /**
     * @test
     */
    public function test_read_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/cliente_negocios/'.$clienteNegocio->id
        );

        $this->assertApiResponse($clienteNegocio->toArray());
    }

    /**
     * @test
     */
    public function test_update_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->create();
        $editedClienteNegocio = factory(ClienteNegocio::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cliente_negocios/'.$clienteNegocio->id,
            $editedClienteNegocio
        );

        $this->assertApiResponse($editedClienteNegocio);
    }

    /**
     * @test
     */
    public function test_delete_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cliente_negocios/'.$clienteNegocio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cliente_negocios/'.$clienteNegocio->id
        );

        $this->response->assertStatus(404);
    }
}
