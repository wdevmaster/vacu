<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 9:06
 */

namespace Modules\Sincronizacion\Services;


use Modules\Animal\Entities\Animal;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Animal\Resolvers\SyncAnimalesResolverInterface;
use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Modules\CondicionCorporal\Repositories\CondicionCorporalRepository;
use Modules\CondicionCorporal\Resolvers\SynCondicionCorporalResolverInterface;
use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Configuracion\Resolvers\SyncConfiguracionResolverInterface;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;

class SyncDataService implements SyncDataServiceInterface
{

    /**
     * @var SyncronizacionRepository
     */
    private $syncronizacionRepository;

    /**
     * @var SyncConfiguracionResolverInterface
     */
    private $configuracionResolver;

    /**
     * @var ConfiguracionRepository
     */
    private $configuracionRepository;

    /**
     * @var SyncAnimalesResolverInterface
     */
    private $syncAnimalesResolver;

    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * @var SynCondicionCorporalResolverInterface
     */
    private $syncCondicionCorporalResolver;

    /**
     * @var CondicionCorporalRepository
     */
    private $condicionCorporalRepository;


    public function __construct(SyncronizacionRepository $syncronizacionRepository,
                                SyncConfiguracionResolverInterface $configuracionResolver,
                                ConfiguracionRepository $configuracionRepository,
                                SyncAnimalesResolverInterface $syncAnimalesResolver,
                                AnimalRepository $animalRepository,
                                SynCondicionCorporalResolverInterface $syncCondicionCorporalResolver,
                                CondicionCorporalRepository $condicionCorporalRepository)
    {
        $this->syncronizacionRepository = $syncronizacionRepository;

        $this->configuracionResolver = $configuracionResolver;
        $this->configuracionRepository = $configuracionRepository;

        $this->syncAnimalesResolver = $syncAnimalesResolver;
        $this->animalRepository = $animalRepository;

        $this->syncCondicionCorporalResolver = $syncCondicionCorporalResolver;
        $this->condicionCorporalRepository = $condicionCorporalRepository;

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function executeService(): array
    {

        $sincronizaciones = $this->syncronizacionRepository->all();
        $results = array();

        if ($sincronizaciones) {

            foreach ($sincronizaciones as $sincronizacion) {
                switch ($sincronizacion->tabla) {
                    case Configuracion::$tableName:
                        $this->configuracionResolver->handle($sincronizacion);

                        break;
                    case Animal::$tableName:
                        $this->syncAnimalesResolver->handle($sincronizacion);
                        break;
                    case CondicionCorporal::$tableName:
                        $this->syncCondicionCorporalResolver->handle($sincronizacion);
                        break;
                }
                $this->syncronizacionRepository->delete($sincronizacion->id);
            }
        }
        $results['configuraciones'] = $this->configuracionRepository->all();
        $results['animales'] = $this->animalRepository->all();
        $results['condiciones_corporales'] = $this->condicionCorporalRepository->all();

        return $results;


    }
}
