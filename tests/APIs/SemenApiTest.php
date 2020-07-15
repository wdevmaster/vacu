<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Semen\Entities\Semen;

class SemenApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_semen()
    {
        $semen = factory(Semen::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/semen/semens', $semen
        )->assertStatus(200);

    }

    /**
     * @test
     */
    public function test_list_semen()
    {
        $semen = factory(Semen::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/semen/semens'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_semen()
    {
        $semen = factory(Semen::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/semen/semens/'.$semen->id
        )->assertStatus(200);
    }


    /**
     * @test
     */
    public function test_update_semen()
    {
        $semen = factory(Semen::class)->create();
        $editedSemen = factory(Semen::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/semen/semens/'.$semen->id,
            $editedSemen
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_semen()
    {
        $semen = factory(Semen::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/semen/semens/'.$semen->id
         )->assertStatus(200);

        $id=$semen->id;
        $data=Semen::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
