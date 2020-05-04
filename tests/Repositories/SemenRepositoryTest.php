<?php namespace Tests\Repositories;

use Modules\Semen\Entities\Semen;
use Modules\Semen\Repositories\SemenRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SemenRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SemenRepository
     */
    protected $semenRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->semenRepo = \App::make(SemenRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_semen()
    {
        $semen = factory(Semen::class)->make()->toArray();

        $createdSemen = $this->semenRepo->create($semen);

        $createdSemen = $createdSemen->toArray();
        $this->assertArrayHasKey('id', $createdSemen);
        $this->assertNotNull($createdSemen['id'], 'Created Semen must have id specified');
        $this->assertNotNull(Semen::find($createdSemen['id']), 'Semen with given id must be in DB');
        $this->assertModelData($semen, $createdSemen);
    }

    /**
     * @test read
     */
    public function test_read_semen()
    {
        $semen = factory(Semen::class)->create();

        $dbSemen = $this->semenRepo->find($semen->id);

        $dbSemen = $dbSemen->toArray();
        $this->assertModelData($semen->toArray(), $dbSemen);
    }

    /**
     * @test update
     */
    public function test_update_semen()
    {
        $semen = factory(Semen::class)->create();
        $fakeSemen = factory(Semen::class)->make()->toArray();

        $updatedSemen = $this->semenRepo->update($fakeSemen, $semen->id);

        $this->assertModelData($fakeSemen, $updatedSemen->toArray());
        $dbSemen = $this->semenRepo->find($semen->id);
        $this->assertModelData($fakeSemen, $dbSemen->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_semen()
    {
        $semen = factory(Semen::class)->create();

        $resp = $this->semenRepo->delete($semen->id);

        $this->assertTrue($resp);
        $this->assertNull(Semen::find($semen->id), 'Semen should not exist in DB');
    }
}
