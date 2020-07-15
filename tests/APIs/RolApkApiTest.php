<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Usuario\Entities\RolBoton;
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
            '/api/v1/rol_apk/roles_apks', $rolApk
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/rol_apk/roles_apks'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/rol_apk/roles_apks/'.$rolApk->id
        )->assertStatus(200);
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
            '/api/v1/rol_apk/roles_apks/'.$rolApk->id,
            $editedRolApk
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_rol_apk()
    {
        $rolApk = factory(RolApk::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/rol_apk/roles_apks/'.$rolApk->id
         )->assertStatus(200);

        $id=$rolApk->id;
        $data=RolApk::all()->where('id','=',$id)->first();
        $estado=1;
        if ($data==null){
            $estado=0;
        }

        $this->assertEquals(0,$estado);
    }

//    /**
//     * @test
//     */
//    public function test_giveRolBoton_to_rol_apk()
//    {
//        $rolBoton= factory(RolBoton::class)->create();
//        $rolApk = factory(RolApk::class)->create();
//        $giveRolBotonTo['id']=$rolBoton->id;
//        $data['giveRolBotonTo']=$giveRolBotonTo;
//
//        $this->response = $this->json(
//            'POST',
//            '/api/v1/rol_apk/roles_apks/'.$rolApk->id.'/give/rol_boton"', $data
//        )->assertStatus(200);
//    }
}
