<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Modules\Bitacora\Entities\Bitacora;
use Tests\TestCase;

class BitacoraApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

       /**
     * @test
     */
    public function test_list_bitacoras()
    {
        factory(Bitacora::class,10)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/bitacora/bitacoras/'
        )->assertStatus(200);

    }


}
