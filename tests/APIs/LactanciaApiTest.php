<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Lactancia\Entities\Lactancia;

class LactanciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_lactancia()
    {
        $lactancia = factory(Lactancia::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/lactancias', $lactancia
        );

        $this->assertApiResponse($lactancia);
    }

    /**
     * @test
     */
    public function test_read_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/lactancias/'.$lactancia->id
        );

        $this->assertApiResponse($lactancia->toArray());
    }

    /**
     * @test
     */
    public function test_update_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();
        $editedLactancia = factory(Lactancia::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/lactancias/'.$lactancia->id,
            $editedLactancia
        );

        $this->assertApiResponse($editedLactancia);
    }

    /**
     * @test
     */
    public function test_delete_lactancia()
    {
        $lactancia = factory(Lactancia::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/lactancias/'.$lactancia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/lactancias/'.$lactancia->id
        );

        $this->response->assertStatus(404);
    }
}
