<?php namespace Tests\Repositories;

use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ConfiguracionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConfiguracionRepository
     */
    protected $configuracionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->configuracionRepo = \App::make(ConfiguracionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_configuracion()
    {
        $configuracion = factory(Configuracion::class)->make()->toArray();

        $createdConfiguracion = $this->configuracionRepo->create($configuracion);

        $createdConfiguracion = $createdConfiguracion->toArray();
        $this->assertArrayHasKey('id', $createdConfiguracion);
        $this->assertNotNull($createdConfiguracion['id'], 'Created Configuracion must have id specified');
        $this->assertNotNull(Configuracion::find($createdConfiguracion['id']), 'Configuracion with given id must be in DB');
        $this->assertModelData($configuracion, $createdConfiguracion);
    }

    /**
     * @test read
     */
    public function test_read_configuracion()
    {
        $configuracion = factory(Configuracion::class)->create();

        $dbConfiguracion = $this->configuracionRepo->find($configuracion->id);

        $dbConfiguracion = $dbConfiguracion->toArray();
        $this->assertModelData($configuracion->toArray(), $dbConfiguracion);
    }

    /**
     * @test update
     */
    public function test_update_configuracion()
    {
        $configuracion = factory(Configuracion::class)->create();
        $fakeConfiguracion = factory(Configuracion::class)->make()->toArray();

        $updatedConfiguracion = $this->configuracionRepo->update($fakeConfiguracion, $configuracion->id);

        $this->assertModelData($fakeConfiguracion, $updatedConfiguracion->toArray());
        $dbConfiguracion = $this->configuracionRepo->find($configuracion->id);
        $this->assertModelData($fakeConfiguracion, $dbConfiguracion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_configuracion()
    {
        $configuracion = factory(Configuracion::class)->create();

        $resp = $this->configuracionRepo->delete($configuracion->id);

        $this->assertTrue($resp);
        $this->assertNull(Configuracion::find($configuracion->id), 'Configuracion should not exist in DB');
    }
}
