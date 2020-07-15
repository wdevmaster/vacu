<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Lote\Entities\Lote;

class LoteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_lote()
    {
        $lote = factory(Lote::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/lote/lotes', $lote
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_lote()
    {
        $lote = factory(Lote::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/lote/lotes'
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_show_lote()
    {
        $lote = factory(Lote::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/lote/lotes/'.$lote->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_update_lote()
    {
        $lote = factory(Lote::class)->create();
        $editedLote = factory(Lote::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/v1/lote/lotes/'.$lote->id,
            $editedLote
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_lote()
    {
        $lote = factory(Lote::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/lote/lotes/'.$lote->id
         )->assertStatus(200);

        $id=$lote->id;
        $data=Lote::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
