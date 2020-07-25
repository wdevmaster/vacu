<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\Palpacion;

class PalpacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_palpacion()
    {
        $palpacion = factory(Palpacion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/palpacions', $palpacion
        );

        $this->assertApiResponse($palpacion);
    }

    /**
     * @test
     */
    public function test_read_palpacion()
    {
        $palpacion = factory(Palpacion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/palpacions/'.$palpacion->id
        );

        $this->assertApiResponse($palpacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_palpacion()
    {
        $palpacion = factory(Palpacion::class)->create();
        $editedPalpacion = factory(Palpacion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/palpacions/'.$palpacion->id,
            $editedPalpacion
        );

        $this->assertApiResponse($editedPalpacion);
    }

    /**
     * @test
     */
    public function test_delete_palpacion()
    {
        $palpacion = factory(Palpacion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/palpacions/'.$palpacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/palpacions/'.$palpacion->id
        );

        $this->response->assertStatus(404);
    }
}
