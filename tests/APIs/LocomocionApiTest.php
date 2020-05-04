<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Locomocion\Entities\Locomocion;

class LocomocionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_locomocion()
    {
        $locomocion = factory(Locomocion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/locomocions', $locomocion
        );

        $this->assertApiResponse($locomocion);
    }

    /**
     * @test
     */
    public function test_read_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/locomocions/'.$locomocion->id
        );

        $this->assertApiResponse($locomocion->toArray());
    }

    /**
     * @test
     */
    public function test_update_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();
        $editedLocomocion = factory(Locomocion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/locomocions/'.$locomocion->id,
            $editedLocomocion
        );

        $this->assertApiResponse($editedLocomocion);
    }

    /**
     * @test
     */
    public function test_delete_locomocion()
    {
        $locomocion = factory(Locomocion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/locomocions/'.$locomocion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/locomocions/'.$locomocion->id
        );

        $this->response->assertStatus(404);
    }
}
