<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\Leche;

class LecheApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_leche()
    {
        $leche = factory(Leche::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/leches', $leche
        );

        $this->assertApiResponse($leche);
    }

    /**
     * @test
     */
    public function test_read_leche()
    {
        $leche = factory(Leche::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/leches/'.$leche->id
        );

        $this->assertApiResponse($leche->toArray());
    }

    /**
     * @test
     */
    public function test_update_leche()
    {
        $leche = factory(Leche::class)->create();
        $editedLeche = factory(Leche::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/leches/'.$leche->id,
            $editedLeche
        );

        $this->assertApiResponse($editedLeche);
    }

    /**
     * @test
     */
    public function test_delete_leche()
    {
        $leche = factory(Leche::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/leches/'.$leche->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/leches/'.$leche->id
        );

        $this->response->assertStatus(404);
    }
}
