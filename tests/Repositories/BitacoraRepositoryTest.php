<?php namespace Tests\Repositories;

use Modules\Bitacora\Entities\Bitacora;
use Modules\Bitacora\Repositories\BitacoraRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BitacoraRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BitacoraRepository
     */
    protected $bitacoraRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bitacoraRepo = \App::make(BitacoraRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_bitacora()
    {
        $bitacora = factory(Bitacora::class)->make()->toArray();

        $createdBitacora = $this->bitacoraRepo->create($bitacora);

        $createdBitacora = $createdBitacora->toArray();
        $this->assertArrayHasKey('id', $createdBitacora);
        $this->assertNotNull($createdBitacora['id'], 'Created Bitacora must have id specified');
        $this->assertNotNull(Bitacora::find($createdBitacora['id']), 'Bitacora with given id must be in DB');
        $this->assertModelData($bitacora, $createdBitacora);
    }

    /**
     * @test read
     */
    public function test_read_bitacora()
    {
        $bitacora = factory(Bitacora::class)->create();

        $dbBitacora = $this->bitacoraRepo->find($bitacora->id);

        $dbBitacora = $dbBitacora->toArray();
        $this->assertModelData($bitacora->toArray(), $dbBitacora);
    }

    /**
     * @test update
     */
    public function test_update_bitacora()
    {
        $bitacora = factory(Bitacora::class)->create();
        $fakeBitacora = factory(Bitacora::class)->make()->toArray();

        $updatedBitacora = $this->bitacoraRepo->update($fakeBitacora, $bitacora->id);

        $this->assertModelData($fakeBitacora, $updatedBitacora->toArray());
        $dbBitacora = $this->bitacoraRepo->find($bitacora->id);
        $this->assertModelData($fakeBitacora, $dbBitacora->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_bitacora()
    {
        $bitacora = factory(Bitacora::class)->create();

        $resp = $this->bitacoraRepo->delete($bitacora->id);

        $this->assertTrue($resp);
        $this->assertNull(Bitacora::find($bitacora->id), 'Bitacora should not exist in DB');
    }
}
