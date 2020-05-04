<?php namespace Tests\Repositories;

use Modules\Parto\Entities\Parto;
use Modules\Parto\Repositories\PartoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PartoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PartoRepository
     */
    protected $partoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->partoRepo = \App::make(PartoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_parto()
    {
        $parto = factory(Parto::class)->make()->toArray();

        $createdParto = $this->partoRepo->create($parto);

        $createdParto = $createdParto->toArray();
        $this->assertArrayHasKey('id', $createdParto);
        $this->assertNotNull($createdParto['id'], 'Created Parto must have id specified');
        $this->assertNotNull(Parto::find($createdParto['id']), 'Parto with given id must be in DB');
        $this->assertModelData($parto, $createdParto);
    }

    /**
     * @test read
     */
    public function test_read_parto()
    {
        $parto = factory(Parto::class)->create();

        $dbParto = $this->partoRepo->find($parto->id);

        $dbParto = $dbParto->toArray();
        $this->assertModelData($parto->toArray(), $dbParto);
    }

    /**
     * @test update
     */
    public function test_update_parto()
    {
        $parto = factory(Parto::class)->create();
        $fakeParto = factory(Parto::class)->make()->toArray();

        $updatedParto = $this->partoRepo->update($fakeParto, $parto->id);

        $this->assertModelData($fakeParto, $updatedParto->toArray());
        $dbParto = $this->partoRepo->find($parto->id);
        $this->assertModelData($fakeParto, $dbParto->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_parto()
    {
        $parto = factory(Parto::class)->create();

        $resp = $this->partoRepo->delete($parto->id);

        $this->assertTrue($resp);
        $this->assertNull(Parto::find($parto->id), 'Parto should not exist in DB');
    }
}
