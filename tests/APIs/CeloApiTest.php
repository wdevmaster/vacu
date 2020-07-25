<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\Celo;

class CeloApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_celo()
    {
        $celo = factory(Celo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/celos', $celo
        );

        $this->assertApiResponse($celo);
    }

    /**
     * @test
     */
    public function test_read_celo()
    {
        $celo = factory(Celo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/celos/'.$celo->id
        );

        $this->assertApiResponse($celo->toArray());
    }

    /**
     * @test
     */
    public function test_update_celo()
    {
        $celo = factory(Celo::class)->create();
        $editedCelo = factory(Celo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/celos/'.$celo->id,
            $editedCelo
        );

        $this->assertApiResponse($editedCelo);
    }

    /**
     * @test
     */
    public function test_delete_celo()
    {
        $celo = factory(Celo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/celos/'.$celo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/celos/'.$celo->id
        );

        $this->response->assertStatus(404);
    }
}
