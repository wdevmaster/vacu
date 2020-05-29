<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\ClienteNegocio;
use Modules\Usuario\Repositories\ClienteNegocioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClienteNegocioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClienteNegocioRepository
     */
    protected $clienteNegocioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clienteNegocioRepo = \App::make(ClienteNegocioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->make()->toArray();

        $createdClienteNegocio = $this->clienteNegocioRepo->create($clienteNegocio);

        $createdClienteNegocio = $createdClienteNegocio->toArray();
        $this->assertArrayHasKey('id', $createdClienteNegocio);
        $this->assertNotNull($createdClienteNegocio['id'], 'Created ClienteNegocio must have id specified');
        $this->assertNotNull(ClienteNegocio::find($createdClienteNegocio['id']), 'ClienteNegocio with given id must be in DB');
        $this->assertModelData($clienteNegocio, $createdClienteNegocio);
    }

    /**
     * @test read
     */
    public function test_read_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->create();

        $dbClienteNegocio = $this->clienteNegocioRepo->find($clienteNegocio->id);

        $dbClienteNegocio = $dbClienteNegocio->toArray();
        $this->assertModelData($clienteNegocio->toArray(), $dbClienteNegocio);
    }

    /**
     * @test update
     */
    public function test_update_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->create();
        $fakeClienteNegocio = factory(ClienteNegocio::class)->make()->toArray();

        $updatedClienteNegocio = $this->clienteNegocioRepo->update($fakeClienteNegocio, $clienteNegocio->id);

        $this->assertModelData($fakeClienteNegocio, $updatedClienteNegocio->toArray());
        $dbClienteNegocio = $this->clienteNegocioRepo->find($clienteNegocio->id);
        $this->assertModelData($fakeClienteNegocio, $dbClienteNegocio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cliente_negocio()
    {
        $clienteNegocio = factory(ClienteNegocio::class)->create();

        $resp = $this->clienteNegocioRepo->delete($clienteNegocio->id);

        $this->assertTrue($resp);
        $this->assertNull(ClienteNegocio::find($clienteNegocio->id), 'ClienteNegocio should not exist in DB');
    }
}
