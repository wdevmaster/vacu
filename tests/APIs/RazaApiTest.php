<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Raza\Entities\Raza;

class RazaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_raza()
    {
        $raza = factory(Raza::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/raza/razas', $raza
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/raza/razas'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/raza/razas/'.$raza->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_raza()
    {
        $raza = factory(Raza::class)->create();
        $editedRaza = factory(Raza::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/raza/razas/'.$raza->id,
            $editedRaza
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/raza/razas/'.$raza->id
         )->assertStatus(200);

        $id=$raza->id;
        $data=Raza::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
