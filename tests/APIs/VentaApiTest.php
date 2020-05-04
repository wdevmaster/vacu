<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Venta\Entities\Venta;

class VentaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_venta()
    {
        $venta = factory(Venta::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ventas', $venta
        );

        $this->assertApiResponse($venta);
    }

    /**
     * @test
     */
    public function test_read_venta()
    {
        $venta = factory(Venta::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/ventas/'.$venta->id
        );

        $this->assertApiResponse($venta->toArray());
    }

    /**
     * @test
     */
    public function test_update_venta()
    {
        $venta = factory(Venta::class)->create();
        $editedVenta = factory(Venta::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ventas/'.$venta->id,
            $editedVenta
        );

        $this->assertApiResponse($editedVenta);
    }

    /**
     * @test
     */
    public function test_delete_venta()
    {
        $venta = factory(Venta::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ventas/'.$venta->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ventas/'.$venta->id
        );

        $this->response->assertStatus(404);
    }
}
