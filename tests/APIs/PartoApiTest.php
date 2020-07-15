<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Parto\Entities\Parto;

class PartoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_parto()
    {
        $parto = factory(Parto::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/parto/partos', $parto
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_parto()
    {
        $parto = factory(Parto::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/parto/partos'
        )->assertStatus(200);
    }


    /**
     * @test
     */
    public function test_Show_parto()
    {
        $parto = factory(Parto::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/parto/partos/'.$parto->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_parto()
    {
        $parto = factory(Parto::class)->create();
        $editedParto = factory(Parto::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/parto/partos/'.$parto->id,
            $editedParto
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_parto()
    {
        $parto = factory(Parto::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/parto/partos/'.$parto->id
         )->assertStatus(200);

        $id=$parto->id;
        $data=Parto::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
