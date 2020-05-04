<?php namespace Tests\Repositories;

use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Modules\CondicionCorporal\Repositories\CondicionCorporalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CondicionCorporalRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CondicionCorporalRepository
     */
    protected $condicionCorporalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->condicionCorporalRepo = \App::make(CondicionCorporalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->make()->toArray();

        $createdCondicionCorporal = $this->condicionCorporalRepo->create($condicionCorporal);

        $createdCondicionCorporal = $createdCondicionCorporal->toArray();
        $this->assertArrayHasKey('id', $createdCondicionCorporal);
        $this->assertNotNull($createdCondicionCorporal['id'], 'Created CondicionCorporal must have id specified');
        $this->assertNotNull(CondicionCorporal::find($createdCondicionCorporal['id']), 'CondicionCorporal with given id must be in DB');
        $this->assertModelData($condicionCorporal, $createdCondicionCorporal);
    }

    /**
     * @test read
     */
    public function test_read_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();

        $dbCondicionCorporal = $this->condicionCorporalRepo->find($condicionCorporal->id);

        $dbCondicionCorporal = $dbCondicionCorporal->toArray();
        $this->assertModelData($condicionCorporal->toArray(), $dbCondicionCorporal);
    }

    /**
     * @test update
     */
    public function test_update_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();
        $fakeCondicionCorporal = factory(CondicionCorporal::class)->make()->toArray();

        $updatedCondicionCorporal = $this->condicionCorporalRepo->update($fakeCondicionCorporal, $condicionCorporal->id);

        $this->assertModelData($fakeCondicionCorporal, $updatedCondicionCorporal->toArray());
        $dbCondicionCorporal = $this->condicionCorporalRepo->find($condicionCorporal->id);
        $this->assertModelData($fakeCondicionCorporal, $dbCondicionCorporal->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();

        $resp = $this->condicionCorporalRepo->delete($condicionCorporal->id);

        $this->assertTrue($resp);
        $this->assertNull(CondicionCorporal::find($condicionCorporal->id), 'CondicionCorporal should not exist in DB');
    }
}
