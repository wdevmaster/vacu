<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Inseminador\Entities\Inseminador;

class InseminadorApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_inseminador()
    {
        $inseminador = factory(Inseminador::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/inseminadors', $inseminador
        );

        $this->assertApiResponse($inseminador);
    }

    /**
     * @test
     */
    public function test_read_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/inseminadors/'.$inseminador->id
        );

        $this->assertApiResponse($inseminador->toArray());
    }

    /**
     * @test
     */
    public function test_update_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();
        $editedInseminador = factory(Inseminador::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/inseminadors/'.$inseminador->id,
            $editedInseminador
        );

        $this->assertApiResponse($editedInseminador);
    }

    /**
     * @test
     */
    public function test_delete_inseminador()
    {
        $inseminador = factory(Inseminador::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/inseminadors/'.$inseminador->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/inseminadors/'.$inseminador->id
        );

        $this->response->assertStatus(404);
    }
}
