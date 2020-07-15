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
            '/api/v1/rol_boton/roles_botones', $rolBoton
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/rol_boton/roles_botones'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/rol_boton/roles_botones/'.$rolBoton->id
        )->assertStatus(200);
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
            '/api/v1/rol_boton/roles_botones/'.$rolBoton->id,
            $editedRolBoton
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_rol_boton()
    {
        $rolBoton = factory(RolBoton::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/rol_boton/roles_botones/'.$rolBoton->id
         )->assertStatus(200);
        $id=$rolBoton->id;
        $data=RolBoton::all()->where('id','=',$id)->first();
        $estado=1;
        if ($data==null){
            $estado=0;
        }

        $this->assertEquals(0,$estado);
    }
}
