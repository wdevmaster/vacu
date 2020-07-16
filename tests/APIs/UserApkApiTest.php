<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Usuario\Entities\RolApk;
use Modules\Usuario\Entities\User;
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
        $user = factory(User::class)->make()->toArray();
        $user['password']= $this->faker->word;

        $this->response = $this->json(
            'POST',
            '/api/v1/user_apk/users_apks', $user
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_user_apk()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $rolApk=factory(RolApk::class)->create();
        $rolApk_id=$rolApk->id;
        $userApk = factory(UserApk::class)->create(['user_id'=>$user_id,'rol_apk_id'=>$rolApk_id]);


        $this->response = $this->json(
            'GET',
            '/api/v1/user_apk/users_apks'
        )->assertStatus(200);
    }


    /**
     * @test
     */
    public function test_show_user_apk()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $rolApk=factory(RolApk::class)->create();
        $rolApk_id=$rolApk->id;
        $userApk = factory(UserApk::class)->create(['user_id'=>$user_id,'rol_apk_id'=>$rolApk_id]);

        $this->response = $this->json(
            'GET',
            '/api/v1/user_apk/users_apks/'.$userApk->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_user_apk()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $rolApk=factory(RolApk::class)->create();
        $rolApk_id=$rolApk->id;
        $userApk = factory(UserApk::class)->create(['user_id'=>$user_id,'rol_apk_id'=>$rolApk_id]);

        $editedUserApk = factory(UserApk::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/user_apk/users_apks/'.$userApk->id,
            $editedUserApk
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_user_apk()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $rolApk=factory(RolApk::class)->create();
        $rolApk_id=$rolApk->id;
        $userApk = factory(UserApk::class)->create(['user_id'=>$user_id,'rol_apk_id'=>$rolApk_id]);

        $this->response = $this->json(
            'DELETE',
             '/api/v1/user_apk/users_apks/'.$userApk->id
         )->assertStatus(200);

        $id=$userApk->id;
        $data=UserApk::all()->where('id','=',$id)->first();
        $estado=1;
        if ($data==null){
            $estado=0;
        }

        $this->assertEquals(0,$estado);

    }



    /**
     * @test
     */
    public function test_giveRolApk_to_user_apk()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $userApk = factory(UserApk::class)->create(['user_id'=>$user_id]);

        $rolApk= factory(RolApk::class)->create();

        $data['giveRolApkTo']=$rolApk->id;

        $this->response = $this->json(
            'POST',
            '/api/v1/user_apk/users_apks/'.$userApk->id.'/give/rol_apk', $data
        )->assertStatus(200);
    }
}
