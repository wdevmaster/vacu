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
            '/api/v1/registro_enfermedad/registros_enfermedades', $registroEnfermedad
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_list_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/registro_enfermedad/registros_enfermedades/'.$registroEnfermedad->id
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_show_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/registro_enfermedad/registros_enfermedades/'.$registroEnfermedad->id
        )->assertStatus(200);
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
            '/api/v1/registro_enfermedad/registros_enfermedades/'.$registroEnfermedad->id,
            $editedRegistroEnfermedad
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_registro_enfermedad()
    {
        $registroEnfermedad = factory(RegistroEnfermedad::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/registro_enfermedad/registros_enfermedades/'.$registroEnfermedad->id
         )->assertStatus(200);

        $id=$registroEnfermedad->id;
        $data=RegistroEnfermedad::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
