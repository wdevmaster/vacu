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
            '/api/v1/condicion_corporal/condiciones_corporales', $condicionCorporal
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_list_condicion_corporal()
    {

        $condicionCorporal = factory(CondicionCorporal::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/condicion_corporal/condiciones_corporales'
        )->assertStatus(200);


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
            '/api/v1/condicion_corporal/condiciones_corporales/'.$condicionCorporal->id,
            $editedCondicionCorporal
        )->assertStatus(200);


    }

    /**
     * @test
     */
    public function test_delete_condicion_corporal()
    {
        $condicionCorporal = factory(CondicionCorporal::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/v1/condicion_corporal/condiciones_corporales/'.$condicionCorporal->id
         )->assertStatus(200);

        $id=$condicionCorporal->id;
        $data=CondicionCorporal::all()->where('id','=',$id)->first();
        $active_estado=$data->active;
        $this->assertEquals(false,$active_estado);
    }
}
