<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Ingreso\Entities\Ingreso;

class IngresoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_ingreso()
    {
        $ingreso = factory(Ingreso::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ingresos', $ingreso
        );

        $this->assertApiResponse($ingreso);
    }

    /**
     * @test
     */
    public function test_read_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/ingresos/'.$ingreso->id
        );

        $this->assertApiResponse($ingreso->toArray());
    }

    /**
     * @test
     */
    public function test_update_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();
        $editedIngreso = factory(Ingreso::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ingresos/'.$ingreso->id,
            $editedIngreso
        );

        $this->assertApiResponse($editedIngreso);
    }

    /**
     * @test
     */
    public function test_delete_ingreso()
    {
        $ingreso = factory(Ingreso::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ingresos/'.$ingreso->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ingresos/'.$ingreso->id
        );

        $this->response->assertStatus(404);
    }
}
