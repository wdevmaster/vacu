<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\UserApi;

class UserApiApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_api()
    {
        $userApi = factory(UserApi::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_apis', $userApi
        );

        $this->assertApiResponse($userApi);
    }

    /**
     * @test
     */
    public function test_read_user_api()
    {
        $userApi = factory(UserApi::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_apis/'.$userApi->id
        );

        $this->assertApiResponse($userApi->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_api()
    {
        $userApi = factory(UserApi::class)->create();
        $editedUserApi = factory(UserApi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_apis/'.$userApi->id,
            $editedUserApi
        );

        $this->assertApiResponse($editedUserApi);
    }

    /**
     * @test
     */
    public function test_delete_user_api()
    {
        $userApi = factory(UserApi::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_apis/'.$userApi->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_apis/'.$userApi->id
        );

        $this->response->assertStatus(404);
    }
}
