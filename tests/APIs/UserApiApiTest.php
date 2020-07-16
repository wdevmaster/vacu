<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Usuario\Entities\User;
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
        $user = factory(User::class)->make()->toArray();
        $user['password']= $this->faker->word;

        $this->response = $this->json(
            'POST',
            '/api/v1/user_api/users_apis', $user
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_user_api()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $userApi = factory(UserApi::class)->create(['user_id'=>$user_id]);

        $this->response = $this->json(
            'GET',
            '/api/v1/user_api/users_apis'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_user_api()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $userApi = factory(UserApi::class)->create(['user_id'=>$user_id]);


        $this->response = $this->json(
            'GET',
            '/api/v1/user_api/users_apis/'.$userApi->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_user_api()
    {
        $user=factory(User::class)->create();
        $user_id=$user->id;
        $userApi = factory(UserApi::class)->create(['user_id'=>$user_id]);

        $editedUserApi = factory(UserApi::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/user_api/users_apis/'.$userApi->id,
            $editedUserApi
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_user_api()
    {


        $user=factory(User::class)->create();
        $user_id=$user->id;
        $userApi = factory(UserApi::class)->create(['user_id'=>$user_id]);

        $this->response = $this->json(
            'DELETE',
             '/api/v1/user_api/users_apis/'.$userApi->id
         )->assertStatus(200);

        $id=$userApi->id;
        $data=UserApi::all()->where('id','=',$id)->first();
        $estado=1;
        if ($data==null){
            $estado=0;
        }

        $this->assertEquals(0,$estado);
    }
}
