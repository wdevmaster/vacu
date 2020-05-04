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
            '/api/muertes', $muerte
        );

        $this->assertApiResponse($muerte);
    }

    /**
     * @test
     */
    public function test_read_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/muertes/'.$muerte->id
        );

        $this->assertApiResponse($muerte->toArray());
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
            '/api/muertes/'.$muerte->id,
            $editedMuerte
        );

        $this->assertApiResponse($editedMuerte);
    }

    /**
     * @test
     */
    public function test_delete_muerte()
    {
        $muerte = factory(Muerte::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/muertes/'.$muerte->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/muertes/'.$muerte->id
        );

        $this->response->assertStatus(404);
    }
}
