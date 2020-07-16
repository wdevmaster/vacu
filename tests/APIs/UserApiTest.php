<?php namespace Tests\APIs;

use http\Params;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Usuario\Entities\User;

class UserApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_user()
    {
        $user = factory(User::class)->make()->toArray();
        $user['password']= $this->faker->word;

        $this->response = $this->json(
            'POST',
            '/api/v1/usuario/usuarios', $user
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_filter_user()
    {
        $user = factory(User::class)->create();


        $data1['ordenado_por']="created_at";
        $data2['direccion']="ASC";
        $data3['filter']=[["negocio_id","=","1"]];

        $this->response = $this->json(
            'GET',
            '/api/v1/usuario/usuarios/filter/all',
            $data1,
            $data2,
            $data3
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_user()
    {
        $user = factory(User::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/usuario/usuarios'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_user()
    {
        $user = factory(User::class)->create();
        $editedUser = factory(User::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/usuario/usuarios/'.$user->id,
            $editedUser
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_user()
    {
        $user = factory(User::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/usuario/usuarios/'.$user->id
         )->assertStatus(200);

        $id=$user->id;
        $data=User::all()->where('id','=',$id)->first();
        $estado=1;
        if ($data==null){
            $estado=0;
        }

        $this->assertEquals(0,$estado);
    }

    /**
     * @test
     */
    public function test_assign_role_to_user()
    {
        $role=  Role::create(['name' => 'Admin']);
        $user = factory(User::class)->create();

        $data['role_id']= $role->id;


        $this->response = $this->json(
            'POST',
            '/api/v1/usuario/usuarios/'.$user->id.'/assign/role',
            $data

        )->assertStatus(200);
    }

}
