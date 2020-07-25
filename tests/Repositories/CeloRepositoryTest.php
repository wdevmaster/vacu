<?php namespace Tests\Repositories;

use Modules\Animal\Entities\Celo;
use Modules\Animal\Repositories\CeloRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CeloRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CeloRepository
     */
    protected $celoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->celoRepo = \App::make(CeloRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_celo()
    {
        $celo = factory(Celo::class)->make()->toArray();

        $createdCelo = $this->celoRepo->create($celo);

        $createdCelo = $createdCelo->toArray();
        $this->assertArrayHasKey('id', $createdCelo);
        $this->assertNotNull($createdCelo['id'], 'Created Celo must have id specified');
        $this->assertNotNull(Celo::find($createdCelo['id']), 'Celo with given id must be in DB');
        $this->assertModelData($celo, $createdCelo);
    }

    /**
     * @test read
     */
    public function test_read_celo()
    {
        $celo = factory(Celo::class)->create();

        $dbCelo = $this->celoRepo->find($celo->id);

        $dbCelo = $dbCelo->toArray();
        $this->assertModelData($celo->toArray(), $dbCelo);
    }

    /**
     * @test update
     */
    public function test_update_celo()
    {
        $celo = factory(Celo::class)->create();
        $fakeCelo = factory(Celo::class)->make()->toArray();

        $updatedCelo = $this->celoRepo->update($fakeCelo, $celo->id);

        $this->assertModelData($fakeCelo, $updatedCelo->toArray());
        $dbCelo = $this->celoRepo->find($celo->id);
        $this->assertModelData($fakeCelo, $dbCelo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_celo()
    {
        $celo = factory(Celo::class)->create();

        $resp = $this->celoRepo->delete($celo->id);

        $this->assertTrue($resp);
        $this->assertNull(Celo::find($celo->id), 'Celo should not exist in DB');
    }
}
