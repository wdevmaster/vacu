<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Enfermedad\Entities\Enfermedad;

class EnfermedadApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/enfermedads', $enfermedad
        );

        $this->assertApiResponse($enfermedad);
    }

    /**
     * @test
     */
    public function test_read_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/enfermedads/'.$enfermedad->id
        );

        $this->assertApiResponse($enfermedad->toArray());
    }

    /**
     * @test
     */
    public function test_update_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();
        $editedEnfermedad = factory(Enfermedad::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/enfermedads/'.$enfermedad->id,
            $editedEnfermedad
        );

        $this->assertApiResponse($editedEnfermedad);
    }

    /**
     * @test
     */
    public function test_delete_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/enfermedads/'.$enfermedad->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/enfermedads/'.$enfermedad->id
        );

        $this->response->assertStatus(404);
    }
}
