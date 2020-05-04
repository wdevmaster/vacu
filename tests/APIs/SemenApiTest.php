<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Semen\Entities\Semen;

class SemenApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_semen()
    {
        $semen = factory(Semen::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/semens', $semen
        );

        $this->assertApiResponse($semen);
    }

    /**
     * @test
     */
    public function test_read_semen()
    {
        $semen = factory(Semen::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/semens/'.$semen->id
        );

        $this->assertApiResponse($semen->toArray());
    }

    /**
     * @test
     */
    public function test_update_semen()
    {
        $semen = factory(Semen::class)->create();
        $editedSemen = factory(Semen::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/semens/'.$semen->id,
            $editedSemen
        );

        $this->assertApiResponse($editedSemen);
    }

    /**
     * @test
     */
    public function test_delete_semen()
    {
        $semen = factory(Semen::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/semens/'.$semen->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/semens/'.$semen->id
        );

        $this->response->assertStatus(404);
    }
}
