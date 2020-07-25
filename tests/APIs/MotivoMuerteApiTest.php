<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Muerte\Entities\MotivoMuerte;

class MotivoMuerteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/motivo_muertes', $motivoMuerte
        );

        $this->assertApiResponse($motivoMuerte);
    }

    /**
     * @test
     */
    public function test_read_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/motivo_muertes/'.$motivoMuerte->id
        );

        $this->assertApiResponse($motivoMuerte->toArray());
    }

    /**
     * @test
     */
    public function test_update_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->create();
        $editedMotivoMuerte = factory(MotivoMuerte::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/motivo_muertes/'.$motivoMuerte->id,
            $editedMotivoMuerte
        );

        $this->assertApiResponse($editedMotivoMuerte);
    }

    /**
     * @test
     */
    public function test_delete_motivo_muerte()
    {
        $motivoMuerte = factory(MotivoMuerte::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/motivo_muertes/'.$motivoMuerte->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/motivo_muertes/'.$motivoMuerte->id
        );

        $this->response->assertStatus(404);
    }
}
