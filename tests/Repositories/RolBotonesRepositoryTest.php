<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\RolBotones;
use Modules\Usuario\Repositories\RolBotonesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RolBotonesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RolBotonesRepository
     */
    protected $rolBotonesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rolBotonesRepo = \App::make(RolBotonesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->make()->toArray();

        $createdRolBotones = $this->rolBotonesRepo->create($rolBotones);

        $createdRolBotones = $createdRolBotones->toArray();
        $this->assertArrayHasKey('id', $createdRolBotones);
        $this->assertNotNull($createdRolBotones['id'], 'Created RolBotones must have id specified');
        $this->assertNotNull(RolBotones::find($createdRolBotones['id']), 'RolBotones with given id must be in DB');
        $this->assertModelData($rolBotones, $createdRolBotones);
    }

    /**
     * @test read
     */
    public function test_read_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->create();

        $dbRolBotones = $this->rolBotonesRepo->find($rolBotones->id);

        $dbRolBotones = $dbRolBotones->toArray();
        $this->assertModelData($rolBotones->toArray(), $dbRolBotones);
    }

    /**
     * @test update
     */
    public function test_update_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->create();
        $fakeRolBotones = factory(RolBotones::class)->make()->toArray();

        $updatedRolBotones = $this->rolBotonesRepo->update($fakeRolBotones, $rolBotones->id);

        $this->assertModelData($fakeRolBotones, $updatedRolBotones->toArray());
        $dbRolBotones = $this->rolBotonesRepo->find($rolBotones->id);
        $this->assertModelData($fakeRolBotones, $dbRolBotones->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->create();

        $resp = $this->rolBotonesRepo->delete($rolBotones->id);

        $this->assertTrue($resp);
        $this->assertNull(RolBotones::find($rolBotones->id), 'RolBotones should not exist in DB');
    }
}
