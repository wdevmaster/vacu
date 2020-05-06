<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Sincronizacion\Entities\Syncronizacion;

class SyncronizacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/syncronizacions', $syncronizacion
        );

        $this->assertApiResponse($syncronizacion);
    }

    /**
     * @test
     */
    public function test_read_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/syncronizacions/'.$syncronizacion->id
        );

        $this->assertApiResponse($syncronizacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->create();
        $editedSyncronizacion = factory(Syncronizacion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/syncronizacions/'.$syncronizacion->id,
            $editedSyncronizacion
        );

        $this->assertApiResponse($editedSyncronizacion);
    }

    /**
     * @test
     */
    public function test_delete_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/syncronizacions/'.$syncronizacion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/syncronizacions/'.$syncronizacion->id
        );

        $this->response->assertStatus(404);
    }
}
