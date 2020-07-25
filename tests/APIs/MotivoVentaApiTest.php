<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Venta\Entities\MotivoVenta;

class MotivoVentaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/motivo_ventas', $motivoVenta
        );

        $this->assertApiResponse($motivoVenta);
    }

    /**
     * @test
     */
    public function test_read_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/motivo_ventas/'.$motivoVenta->id
        );

        $this->assertApiResponse($motivoVenta->toArray());
    }

    /**
     * @test
     */
    public function test_update_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->create();
        $editedMotivoVenta = factory(MotivoVenta::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/motivo_ventas/'.$motivoVenta->id,
            $editedMotivoVenta
        );

        $this->assertApiResponse($editedMotivoVenta);
    }

    /**
     * @test
     */
    public function test_delete_motivo_venta()
    {
        $motivoVenta = factory(MotivoVenta::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/motivo_ventas/'.$motivoVenta->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/motivo_ventas/'.$motivoVenta->id
        );

        $this->response->assertStatus(404);
    }
}
