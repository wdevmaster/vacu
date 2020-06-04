<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\UserApk;

class UserApkApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user_apk()
    {
        $userApk = factory(UserApk::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/user_apks', $userApk
        );

        $this->assertApiResponse($userApk);
    }

    /**
     * @test
     */
    public function test_read_user_apk()
    {
        $userApk = factory(UserApk::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/user_apks/'.$userApk->id
        );

        $this->assertApiResponse($userApk->toArray());
    }

    /**
     * @test
     */
    public function test_update_user_apk()
    {
        $userApk = factory(UserApk::class)->create();
        $editedUserApk = factory(UserApk::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/user_apks/'.$userApk->id,
            $editedUserApk
        );

        $this->assertApiResponse($editedUserApk);
    }

    /**
     * @test
     */
    public function test_delete_user_apk()
    {
        $userApk = factory(UserApk::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/user_apks/'.$userApk->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/user_apks/'.$userApk->id
        );

        $this->response->assertStatus(404);
    }
}
