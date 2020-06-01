<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\RolBoton;
use Modules\Usuario\Repositories\RolBotonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RolBotonRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RolBotonRepository
     */
    protected $rolBotonRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rolBotonRepo = \App::make(RolBotonRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->make()->toArray();

        $createdRolBoton = $this->rolBotonRepo->create($rolBoton);

        $createdRolBoton = $createdRolBoton->toArray();
        $this->assertArrayHasKey('id', $createdRolBoton);
        $this->assertNotNull($createdRolBoton['id'], 'Created RolBoton must have id specified');
        $this->assertNotNull(RolBoton::find($createdRolBoton['id']), 'RolBoton with given id must be in DB');
        $this->assertModelData($rolBoton, $createdRolBoton);
    }

    /**
     * @test read
     */
    public function test_read_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $dbRolBoton = $this->rolBotonRepo->find($rolBoton->id);

        $dbRolBoton = $dbRolBoton->toArray();
        $this->assertModelData($rolBoton->toArray(), $dbRolBoton);
    }

    /**
     * @test update
     */
    public function test_update_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();
        $fakeRolBoton = factory(RolBoton::class)->make()->toArray();

        $updatedRolBoton = $this->rolBotonRepo->update($fakeRolBoton, $rolBoton->id);

        $this->assertModelData($fakeRolBoton, $updatedRolBoton->toArray());
        $dbRolBoton = $this->rolBotonRepo->find($rolBoton->id);
        $this->assertModelData($fakeRolBoton, $dbRolBoton->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $resp = $this->rolBotonRepo->delete($rolBoton->id);

        $this->assertTrue($resp);
        $this->assertNull(RolBoton::find($rolBoton->id), 'RolBoton should not exist in DB');
    }
}
