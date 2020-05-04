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
            '/api/razas', $raza
        );

        $this->assertApiResponse($raza);
    }

    /**
     * @test
     */
    public function test_read_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/razas/'.$raza->id
        );

        $this->assertApiResponse($raza->toArray());
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
            '/api/razas/'.$raza->id,
            $editedRaza
        );

        $this->assertApiResponse($editedRaza);
    }

    /**
     * @test
     */
    public function test_delete_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/razas/'.$raza->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/razas/'.$raza->id
        );

        $this->response->assertStatus(404);
    }
}
