<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Bitacora\Entities\Bitacora;

class BitacoraApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_bitacora()
    {
        $bitacora = factory(Bitacora::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/bitacoras', $bitacora
        );

        $this->assertApiResponse($bitacora);
    }

    /**
     * @test
     */
    public function test_read_bitacora()
    {
        $bitacora = factory(Bitacora::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/bitacoras/'.$bitacora->id
        );

        $this->assertApiResponse($bitacora->toArray());
    }

    /**
     * @test
     */
    public function test_update_bitacora()
    {
        $bitacora = factory(Bitacora::class)->create();
        $editedBitacora = factory(Bitacora::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/bitacoras/'.$bitacora->id,
            $editedBitacora
        );

        $this->assertApiResponse($editedBitacora);
    }

    /**
     * @test
     */
    public function test_delete_bitacora()
    {
        $bitacora = factory(Bitacora::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/bitacoras/'.$bitacora->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/bitacoras/'.$bitacora->id
        );

        $this->response->assertStatus(404);
    }
}
