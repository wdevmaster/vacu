<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Negocio\Entities\Negocio;
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
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();
        $clienteNegocio['negocio_id'] = $id_negocio;

        $this->response = $this->json(
            'POST',
            '/api/v1/usuario/clientes_negocios', $clienteNegocio
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_show_cliente_negocio()
    {
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();
        $clienteNegocio['negocio_id'] = $id_negocio;
        $result=factory(ClienteNegocio::class)->create($clienteNegocio);

        $this->response = $this->json(
            'GET',
            '/api/v1/usuario/clientes_negocios/'.$result->id
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_cliente_negocio()
    {
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();
        $clienteNegocio['negocio_id'] = $id_negocio;

        factory(ClienteNegocio::class)->create($clienteNegocio);

        $this->response = $this->json(
            'GET',
            '/api/v1/usuario/clientes_negocios'
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_update_cliente_negocio()
    {
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();
        $clienteNegocio['negocio_id'] = $id_negocio;
        $result=factory(ClienteNegocio::class)->create($clienteNegocio);
        $editedClienteNegocio = factory(ClienteNegocio::class)->make()->toArray();
        $editedClienteNegocio['negocio_id'] = $id_negocio;

        $this->response = $this->json(
            'PUT',
            '/api/v1/usuario/clientes_negocios/'.$result->id,
            $editedClienteNegocio
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_cliente_negocio()
    {
        $negocio = factory(Negocio::class)->create();
        $id_negocio=$negocio->id;
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();
        $clienteNegocio['negocio_id'] = $id_negocio;
        $result=factory(ClienteNegocio::class)->create($clienteNegocio);

        $this->response = $this->json(
            'DELETE',
             '/api/v1/usuario/clientes_negocios/'.$result->id
         )->assertStatus(200);

        $id=$result->id;
        $data=ClienteNegocio::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
