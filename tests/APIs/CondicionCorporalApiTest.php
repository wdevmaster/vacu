<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\CondicionCorporal\Entities\CondicionCorporal;

class CondicionCorporalApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/condicion_corporals', $condicionCorporal
        );

        $this->assertApiResponse($condicionCorporal);
    }

    /**
     * @test
     */
    public function test_read_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/condicion_corporals/'.$condicionCorporal->id
        );

        $this->assertApiResponse($condicionCorporal->toArray());
    }

    /**
     * @test
     */
    public function test_update_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();
        $editedCondicionCorporal = factory(CondicionCorporal::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/condicion_corporals/'.$condicionCorporal->id,
            $editedCondicionCorporal
        );

        $this->assertApiResponse($editedCondicionCorporal);
    }

    /**
     * @test
     */
    public function test_delete_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/condicion_corporals/'.$condicionCorporal->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/condicion_corporals/'.$condicionCorporal->id
        );

        $this->response->assertStatus(404);
    }
}
