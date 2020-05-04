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
            '/api/partos', $parto
        );

        $this->assertApiResponse($parto);
    }

    /**
     * @test
     */
    public function test_read_parto()
    {
        $parto = factory(Parto::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/partos/'.$parto->id
        );

        $this->assertApiResponse($parto->toArray());
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
            '/api/partos/'.$parto->id,
            $editedParto
        );

        $this->assertApiResponse($editedParto);
    }

    /**
     * @test
     */
    public function test_delete_parto()
    {
        $parto = factory(Parto::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/partos/'.$parto->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/partos/'.$parto->id
        );

        $this->response->assertStatus(404);
    }
}
