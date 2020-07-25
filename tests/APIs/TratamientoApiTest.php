<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Animal\Entities\Tratamiento;

class TratamientoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tratamientos', $tratamiento
        );

        $this->assertApiResponse($tratamiento);
    }

    /**
     * @test
     */
    public function test_read_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tratamientos/'.$tratamiento->id
        );

        $this->assertApiResponse($tratamiento->toArray());
    }

    /**
     * @test
     */
    public function test_update_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->create();
        $editedTratamiento = factory(Tratamiento::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tratamientos/'.$tratamiento->id,
            $editedTratamiento
        );

        $this->assertApiResponse($editedTratamiento);
    }

    /**
     * @test
     */
    public function test_delete_tratamiento()
    {
        $tratamiento = factory(Tratamiento::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tratamientos/'.$tratamiento->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tratamientos/'.$tratamiento->id
        );

        $this->response->assertStatus(404);
    }
}
