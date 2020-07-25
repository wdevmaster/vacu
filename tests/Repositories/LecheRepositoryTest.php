<?php namespace Tests\Repositories;

use Modules\Animal\Entities\Leche;
use Modules\Animal\Repositories\LecheRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LecheRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LecheRepository
     */
    protected $lecheRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lecheRepo = \App::make(LecheRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_leche()
    {
        $leche = factory(Leche::class)->make()->toArray();

        $createdLeche = $this->lecheRepo->create($leche);

        $createdLeche = $createdLeche->toArray();
        $this->assertArrayHasKey('id', $createdLeche);
        $this->assertNotNull($createdLeche['id'], 'Created Leche must have id specified');
        $this->assertNotNull(Leche::find($createdLeche['id']), 'Leche with given id must be in DB');
        $this->assertModelData($leche, $createdLeche);
    }

    /**
     * @test read
     */
    public function test_read_leche()
    {
        $leche = factory(Leche::class)->create();

        $dbLeche = $this->lecheRepo->find($leche->id);

        $dbLeche = $dbLeche->toArray();
        $this->assertModelData($leche->toArray(), $dbLeche);
    }

    /**
     * @test update
     */
    public function test_update_leche()
    {
        $leche = factory(Leche::class)->create();
        $fakeLeche = factory(Leche::class)->make()->toArray();

        $updatedLeche = $this->lecheRepo->update($fakeLeche, $leche->id);

        $this->assertModelData($fakeLeche, $updatedLeche->toArray());
        $dbLeche = $this->lecheRepo->find($leche->id);
        $this->assertModelData($fakeLeche, $dbLeche->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_leche()
    {
        $leche = factory(Leche::class)->create();

        $resp = $this->lecheRepo->delete($leche->id);

        $this->assertTrue($resp);
        $this->assertNull(Leche::find($leche->id), 'Leche should not exist in DB');
    }
}
