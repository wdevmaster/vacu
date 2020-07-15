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
            '/api/v1/enfermedad/enfermedades', $enfermedad
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/enfermedad/enfermedades'
        )->assertStatus(200);


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
            '/api/v1/enfermedad/enfermedades/'.$enfermedad->id,
            $editedEnfermedad
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_delete_enfermedad()
    {
        $enfermedad = factory(Enfermedad::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/enfermedad/enfermedades/'.$enfermedad->id
         )->assertStatus(200);

        $id=$enfermedad->id;
        $data=Enfermedad::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);


    }
}
