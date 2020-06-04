<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\RolApkRolBoton;

class RolApkRolBotonApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rol_apk_rol_botons', $rolApkRolBoton
        );

        $this->assertApiResponse($rolApkRolBoton);
    }

    /**
     * @test
     */
    public function test_read_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/rol_apk_rol_botons/'.$rolApkRolBoton->id
        );

        $this->assertApiResponse($rolApkRolBoton->toArray());
    }

    /**
     * @test
     */
    public function test_update_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->create();
        $editedRolApkRolBoton = factory(RolApkRolBoton::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rol_apk_rol_botons/'.$rolApkRolBoton->id,
            $editedRolApkRolBoton
        );

        $this->assertApiResponse($editedRolApkRolBoton);
    }

    /**
     * @test
     */
    public function test_delete_rol_apk_rol_boton()
    {
        $rolApkRolBoton = factory(RolApkRolBoton::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rol_apk_rol_botons/'.$rolApkRolBoton->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rol_apk_rol_botons/'.$rolApkRolBoton->id
        );

        $this->response->assertStatus(404);
    }
}
