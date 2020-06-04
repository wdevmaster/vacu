<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\RolApkRolBoton;
use Modules\Usuario\Repositories\RolApkRolBotonRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RolApkRolBotonRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RolApkRolBotonRepository
     */
    protected $rolApkRolBotonRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rolApkRolBotonRepo = \App::make(RolApkRolBotonRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->make()->toArray();

        $createdRolApkRolBoton = $this->rolApkRolBotonRepo->create($rolApkRolBoton);

        $createdRolApkRolBoton = $createdRolApkRolBoton->toArray();
        $this->assertArrayHasKey('id', $createdRolApkRolBoton);
        $this->assertNotNull($createdRolApkRolBoton['id'], 'Created RolApkRolBoton must have id specified');
        $this->assertNotNull(RolApkRolBoton::find($createdRolApkRolBoton['id']), 'RolApkRolBoton with given id must be in DB');
        $this->assertModelData($rolApkRolBoton, $createdRolApkRolBoton);
    }

    /**
     * @test read
     */
    public function test_read_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->create();

        $dbRolApkRolBoton = $this->rolApkRolBotonRepo->find($rolApkRolBoton->id);

        $dbRolApkRolBoton = $dbRolApkRolBoton->toArray();
        $this->assertModelData($rolApkRolBoton->toArray(), $dbRolApkRolBoton);
    }

    /**
     * @test update
     */
    public function test_update_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->create();
        $fakeRolApkRolBoton = factory(RolApkRolBoton::class)->make()->toArray();

        $updatedRolApkRolBoton = $this->rolApkRolBotonRepo->update($fakeRolApkRolBoton, $rolApkRolBoton->id);

        $this->assertModelData($fakeRolApkRolBoton, $updatedRolApkRolBoton->toArray());
        $dbRolApkRolBoton = $this->rolApkRolBotonRepo->find($rolApkRolBoton->id);
        $this->assertModelData($fakeRolApkRolBoton, $dbRolApkRolBoton->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->create();

        $resp = $this->rolApkRolBotonRepo->delete($rolApkRolBoton->id);

        $this->assertTrue($resp);
        $this->assertNull(RolApkRolBoton::find($rolApkRolBoton->id), 'RolApkRolBoton should not exist in DB');
    }
}
