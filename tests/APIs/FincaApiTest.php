<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Finca\Entities\Finca;

class FincaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_finca()
    {
        $finca = factory(Finca::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/fincas', $finca
        );

        $this->assertApiResponse($finca);
    }

    /**
     * @test
     */
    public function test_read_finca()
    {
        $finca = factory(Finca::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/fincas/'.$finca->id
        );

        $this->assertApiResponse($finca->toArray());
    }

    /**
     * @test
     */
    public function test_update_finca()
    {
        $finca = factory(Finca::class)->create();
        $editedFinca = factory(Finca::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/fincas/'.$finca->id,
            $editedFinca
        );

        $this->assertApiResponse($editedFinca);
    }

    /**
     * @test
     */
    public function test_delete_finca()
    {
        $finca = factory(Finca::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/fincas/'.$finca->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/fincas/'.$finca->id
        );

        $this->response->assertStatus(404);
    }
}
