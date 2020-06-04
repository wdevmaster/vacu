<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\UserApk;
use Modules\Usuario\Repositories\UserApkRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserApkRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserApkRepository
     */
    protected $userApkRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userApkRepo = \App::make(UserApkRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_apk()
    {
        $userApk = factory(UserApk::class)->make()->toArray();

        $createdUserApk = $this->userApkRepo->create($userApk);

        $createdUserApk = $createdUserApk->toArray();
        $this->assertArrayHasKey('id', $createdUserApk);
        $this->assertNotNull($createdUserApk['id'], 'Created UserApk must have id specified');
        $this->assertNotNull(UserApk::find($createdUserApk['id']), 'UserApk with given id must be in DB');
        $this->assertModelData($userApk, $createdUserApk);
    }

    /**
     * @test read
     */
    public function test_read_user_apk()
    {
        $userApk = factory(UserApk::class)->create();

        $dbUserApk = $this->userApkRepo->find($userApk->id);

        $dbUserApk = $dbUserApk->toArray();
        $this->assertModelData($userApk->toArray(), $dbUserApk);
    }

    /**
     * @test update
     */
    public function test_update_user_apk()
    {
        $userApk = factory(UserApk::class)->create();
        $fakeUserApk = factory(UserApk::class)->make()->toArray();

        $updatedUserApk = $this->userApkRepo->update($fakeUserApk, $userApk->id);

        $this->assertModelData($fakeUserApk, $updatedUserApk->toArray());
        $dbUserApk = $this->userApkRepo->find($userApk->id);
        $this->assertModelData($fakeUserApk, $dbUserApk->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_apk()
    {
        $userApk = factory(UserApk::class)->create();

        $resp = $this->userApkRepo->delete($userApk->id);

        $this->assertTrue($resp);
        $this->assertNull(UserApk::find($userApk->id), 'UserApk should not exist in DB');
    }
}
