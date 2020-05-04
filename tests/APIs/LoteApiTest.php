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
            '/api/lotes', $lote
        );

        $this->assertApiResponse($lote);
    }

    /**
     * @test
     */
    public function test_read_lote()
    {
        $lote = factory(Lote::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/lotes/'.$lote->id
        );

        $this->assertApiResponse($lote->toArray());
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
            '/api/lotes/'.$lote->id,
            $editedLote
        );

        $this->assertApiResponse($editedLote);
    }

    /**
     * @test
     */
    public function test_delete_lote()
    {
        $lote = factory(Lote::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/lotes/'.$lote->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/lotes/'.$lote->id
        );

        $this->response->assertStatus(404);
    }
}
