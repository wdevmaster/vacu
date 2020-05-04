<?php namespace Tests\Repositories;

use Modules\Raza\Entities\Raza;
use Modules\Raza\Repositories\RazaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RazaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RazaRepository
     */
    protected $razaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->razaRepo = \App::make(RazaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_raza()
    {
        $raza = factory(Raza::class)->make()->toArray();

        $createdRaza = $this->razaRepo->create($raza);

        $createdRaza = $createdRaza->toArray();
        $this->assertArrayHasKey('id', $createdRaza);
        $this->assertNotNull($createdRaza['id'], 'Created Raza must have id specified');
        $this->assertNotNull(Raza::find($createdRaza['id']), 'Raza with given id must be in DB');
        $this->assertModelData($raza, $createdRaza);
    }

    /**
     * @test read
     */
    public function test_read_raza()
    {
        $raza = factory(Raza::class)->create();

        $dbRaza = $this->razaRepo->find($raza->id);

        $dbRaza = $dbRaza->toArray();
        $this->assertModelData($raza->toArray(), $dbRaza);
    }

    /**
     * @test update
     */
    public function test_update_raza()
    {
        $raza = factory(Raza::class)->create();
        $fakeRaza = factory(Raza::class)->make()->toArray();

        $updatedRaza = $this->razaRepo->update($fakeRaza, $raza->id);

        $this->assertModelData($fakeRaza, $updatedRaza->toArray());
        $dbRaza = $this->razaRepo->find($raza->id);
        $this->assertModelData($fakeRaza, $dbRaza->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_raza()
    {
        $raza = factory(Raza::class)->create();

        $resp = $this->razaRepo->delete($raza->id);

        $this->assertTrue($resp);
        $this->assertNull(Raza::find($raza->id), 'Raza should not exist in DB');
    }
}
