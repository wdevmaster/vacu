<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Muerte\Entities\Muerte;

class MuerteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_muerte()
    {
        $muerte = factory(Muerte::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/muerte/muertes', $muerte
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/muerte/muertes'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/muerte/muertes/'.$muerte->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_muerte()
    {
        $muerte = factory(Muerte::class)->create();
        $editedMuerte = factory(Muerte::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/muerte/muertes/'.$muerte->id,
            $editedMuerte
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/muerte/muertes/'.$muerte->id
         )->assertStatus(200);

        $id=$muerte->id;
        $data=Muerte::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
