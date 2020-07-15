<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Cliente\Entities\Cliente;

class ClienteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cliente()
    {
        $cliente = factory(Cliente::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/cliente/clientes', $cliente
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_cliente()
    {
        $cliente = factory(Cliente::class,10)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/cliente/clientes/'
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_update_cliente()
    {
        $cliente = factory(Cliente::class)->create();
        $editedCliente = factory(Cliente::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/cliente/clientes/'.$cliente->id,
            $editedCliente
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_delete_cliente()
    {
        $cliente = factory(Cliente::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/cliente/clientes/'.$cliente->id
         )->assertStatus(200);

        $id=$cliente->id;
        $data=Cliente::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
