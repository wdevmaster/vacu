<?php namespace Tests\Repositories;

use Modules\Evento\Entities\Evento;
use Modules\Evento\Repositories\EventoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EventoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EventoRepository
     */
    protected $eventoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->eventoRepo = \App::make(EventoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evento()
    {
        $evento = factory(Evento::class)->make()->toArray();

        $createdEvento = $this->eventoRepo->create($evento);

        $createdEvento = $createdEvento->toArray();
        $this->assertArrayHasKey('id', $createdEvento);
        $this->assertNotNull($createdEvento['id'], 'Created Evento must have id specified');
        $this->assertNotNull(Evento::find($createdEvento['id']), 'Evento with given id must be in DB');
        $this->assertModelData($evento, $createdEvento);
    }

    /**
     * @test read
     */
    public function test_read_evento()
    {
        $evento = factory(Evento::class)->create();

        $dbEvento = $this->eventoRepo->find($evento->id);

        $dbEvento = $dbEvento->toArray();
        $this->assertModelData($evento->toArray(), $dbEvento);
    }

    /**
     * @test update
     */
    public function test_update_evento()
    {
        $evento = factory(Evento::class)->create();
        $fakeEvento = factory(Evento::class)->make()->toArray();

        $updatedEvento = $this->eventoRepo->update($fakeEvento, $evento->id);

        $this->assertModelData($fakeEvento, $updatedEvento->toArray());
        $dbEvento = $this->eventoRepo->find($evento->id);
        $this->assertModelData($fakeEvento, $dbEvento->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evento()
    {
        $evento = factory(Evento::class)->create();

        $resp = $this->eventoRepo->delete($evento->id);

        $this->assertTrue($resp);
        $this->assertNull(Evento::find($evento->id), 'Evento should not exist in DB');
    }
}
