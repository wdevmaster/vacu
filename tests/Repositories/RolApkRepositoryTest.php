<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\RolApk;
use Modules\Usuario\Repositories\RolApkRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RolApkRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RolApkRepository
     */
    protected $rolApkRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->rolApkRepo = \App::make(RolApkRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_rol_apk()
    {
        $rolApk = factory(RolApk::class)->make()->toArray();

        $createdRolApk = $this->rolApkRepo->create($rolApk);

        $createdRolApk = $createdRolApk->toArray();
        $this->assertArrayHasKey('id', $createdRolApk);
        $this->assertNotNull($createdRolApk['id'], 'Created RolApk must have id specified');
        $this->assertNotNull(RolApk::find($createdRolApk['id']), 'RolApk with given id must be in DB');
        $this->assertModelData($rolApk, $createdRolApk);
    }

    /**
     * @test read
     */
    public function test_read_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $dbRolApk = $this->rolApkRepo->find($rolApk->id);

        $dbRolApk = $dbRolApk->toArray();
        $this->assertModelData($rolApk->toArray(), $dbRolApk);
    }

    /**
     * @test update
     */
    public function test_update_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();
        $fakeRolApk = factory(RolApk::class)->make()->toArray();

        $updatedRolApk = $this->rolApkRepo->update($fakeRolApk, $rolApk->id);

        $this->assertModelData($fakeRolApk, $updatedRolApk->toArray());
        $dbRolApk = $this->rolApkRepo->find($rolApk->id);
        $this->assertModelData($fakeRolApk, $dbRolApk->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $resp = $this->rolApkRepo->delete($rolApk->id);

        $this->assertTrue($resp);
        $this->assertNull(RolApk::find($rolApk->id), 'RolApk should not exist in DB');
    }
}
