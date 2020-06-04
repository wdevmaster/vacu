<?php namespace Tests\Repositories;

use Modules\Usuario\Entities\UserApi;
use Modules\Usuario\Repositories\UserApiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UserApiRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserApiRepository
     */
    protected $userApiRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userApiRepo = \App::make(UserApiRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_user_api()
    {
        $userApi = factory(UserApi::class)->make()->toArray();

        $createdUserApi = $this->userApiRepo->create($userApi);

        $createdUserApi = $createdUserApi->toArray();
        $this->assertArrayHasKey('id', $createdUserApi);
        $this->assertNotNull($createdUserApi['id'], 'Created UserApi must have id specified');
        $this->assertNotNull(UserApi::find($createdUserApi['id']), 'UserApi with given id must be in DB');
        $this->assertModelData($userApi, $createdUserApi);
    }

    /**
     * @test read
     */
    public function test_read_user_api()
    {
        $userApi = factory(UserApi::class)->create();

        $dbUserApi = $this->userApiRepo->find($userApi->id);

        $dbUserApi = $dbUserApi->toArray();
        $this->assertModelData($userApi->toArray(), $dbUserApi);
    }

    /**
     * @test update
     */
    public function test_update_user_api()
    {
        $userApi = factory(UserApi::class)->create();
        $fakeUserApi = factory(UserApi::class)->make()->toArray();

        $updatedUserApi = $this->userApiRepo->update($fakeUserApi, $userApi->id);

        $this->assertModelData($fakeUserApi, $updatedUserApi->toArray());
        $dbUserApi = $this->userApiRepo->find($userApi->id);
        $this->assertModelData($fakeUserApi, $dbUserApi->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_user_api()
    {
        $userApi = factory(UserApi::class)->create();

        $resp = $this->userApiRepo->delete($userApi->id);

        $this->assertTrue($resp);
        $this->assertNull(UserApi::find($userApi->id), 'UserApi should not exist in DB');
    }
}
