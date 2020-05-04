<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;

class RegistroEnfermedadApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/registro_enfermedads', $registroEnfermedad
        );

        $this->assertApiResponse($registroEnfermedad);
    }

    /**
     * @test
     */
    public function test_read_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/registro_enfermedads/'.$registroEnfermedad->id
        );

        $this->assertApiResponse($registroEnfermedad->toArray());
    }

    /**
     * @test
     */
    public function test_update_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();
        $editedRegistroEnfermedad = factory(RegistroEnfermedad::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/registro_enfermedads/'.$registroEnfermedad->id,
            $editedRegistroEnfermedad
        );

        $this->assertApiResponse($editedRegistroEnfermedad);
    }

    /**
     * @test
     */
    public function test_delete_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/registro_enfermedads/'.$registroEnfermedad->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/registro_enfermedads/'.$registroEnfermedad->id
        );

        $this->response->assertStatus(404);
    }
}
