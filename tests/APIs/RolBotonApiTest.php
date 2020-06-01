<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\RolBoton;

class RolBotonApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/rol_botons', $rolBoton
        );

        $this->assertApiResponse($rolBoton);
    }

    /**
     * @test
     */
    public function test_read_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/rol_botons/'.$rolBoton->id
        );

        $this->assertApiResponse($rolBoton->toArray());
    }

    /**
     * @test
     */
    public function test_update_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();
        $editedRolBoton = factory(RolBoton::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/rol_botons/'.$rolBoton->id,
            $editedRolBoton
        );

        $this->assertApiResponse($editedRolBoton);
    }

    /**
     * @test
     */
    public function test_delete_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/rol_botons/'.$rolBoton->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/rol_botons/'.$rolBoton->id
        );

        $this->response->assertStatus(404);
    }
}
