<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\RolApk;

class RolApkApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rol_apk()
    {
        $rolApk = factory(RolApk::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rol_apks', $rolApk
        );

        $this->assertApiResponse($rolApk);
    }

    /**
     * @test
     */
    public function test_read_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/rol_apks/'.$rolApk->id
        );

        $this->assertApiResponse($rolApk->toArray());
    }

    /**
     * @test
     */
    public function test_update_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();
        $editedRolApk = factory(RolApk::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rol_apks/'.$rolApk->id,
            $editedRolApk
        );

        $this->assertApiResponse($editedRolApk);
    }

    /**
     * @test
     */
    public function test_delete_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rol_apks/'.$rolApk->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rol_apks/'.$rolApk->id
        );

        $this->response->assertStatus(404);
    }
}
