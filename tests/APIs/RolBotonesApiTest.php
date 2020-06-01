<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\RolBotones;

class RolBotonesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rol_botones', $rolBotones
        );

        $this->assertApiResponse($rolBotones);
    }

    /**
     * @test
     */
    public function test_read_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/rol_botones/'.$rolBotones->id
        );

        $this->assertApiResponse($rolBotones->toArray());
    }

    /**
     * @test
     */
    public function test_update_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->create();
        $editedRolBotones = factory(RolBotones::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rol_botones/'.$rolBotones->id,
            $editedRolBotones
        );

        $this->assertApiResponse($editedRolBotones);
    }

    /**
     * @test
     */
    public function test_delete_rol_botones()
    {
        $rolBotones = factory(RolBotones::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rol_botones/'.$rolBotones->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rol_botones/'.$rolBotones->id
        );

        $this->response->assertStatus(404);
    }
}
