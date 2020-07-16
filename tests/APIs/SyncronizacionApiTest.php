<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Negocio\Entities\Negocio;
use Modules\Usuario\Entities\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\ApiTestTrait;
use Modules\Sincronizacion\Entities\Syncronizacion;

class SyncronizacionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_syncronizacion()
    {
        $syncronizacion = factory(Syncronizacion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/v1/sincronizacion/sincronizaciones', $syncronizacion
        )->assertStatus(200);
    }

    /**
     * @test
     */
    public function test_start_syncronizacion()
    {
        $user=factory(User::class)->create();
        Role::create(['name' => 'Admin']);
        $user->assignRole('Admin');

        $this->actingAs($user, 'api');
        $token = $user->api_token;
        $headers = ['Authorization' => "Bearer $token"];

        $negocio=factory(Negocio::class)->create();
        $syncronizacion = factory(Syncronizacion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/v1/sincronizacion/sincronizaciones/start/'.$negocio->id, $headers
        )->assertStatus(200);
    }


}
