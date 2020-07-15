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
            '/api/v1/venta/ventas', $venta
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_venta()
    {
        $venta = factory(Venta::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/venta/ventas'
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_venta()
    {
        $venta = factory(Venta::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/venta/ventas/'.$venta->id
        )->assertStatus(200);
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
            '/api/v1/venta/ventas/'.$venta->id,
            $editedVenta
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_venta()
    {
        $venta = factory(Venta::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/venta/ventas/'.$venta->id
         )->assertStatus(200);

        $id=$venta->id;
        $data=Venta::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
