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



    public function __construct(SyncronizacionRepository $syncronizacionRepository,
                                SyncConfiguracionResolverInterface $configuracionResolver,
                                ConfiguracionRepository $configuracionRepository,
                                SyncAnimalesResolverInterface $syncAnimalesResolver,
                                AnimalRepository $animalRepository)
    {
        $this->syncronizacionRepository = $syncronizacionRepository;

        $this->configuracionResolver = $configuracionResolver;
        $this->configuracionRepository = $configuracionRepository;

        $this->syncAnimalesResolver = $syncAnimalesResolver;
        $this->animalRepository = $animalRepository;

    }

    public function executeService() :array
    {
        try {
            $sincronizaciones = $this->syncronizacionRepository->all();
            $results = array();

            if ($sincronizaciones) {

                foreach ($sincronizaciones as $sincronizacion) {
                    switch ($sincronizacion->tabla) {
                        case Configuracion::$tableName:
                            $this->configuracionResolver->handle($sincronizacion);
                            $this->syncronizacionRepository->delete($sincronizacion->id);
                            break;
                        case Animal::$tableName:
                            $this->syncAnimalesResolver->handle($sincronizacion);
                            $this->syncronizacionRepository->delete($sincronizacion->id);
                            break;
                    }
                }
            }
            $results['configuraciones'] = $this->configuracionRepository->all();
            $results['animales'] = $this->animalRepository->all();

            return $results;
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }


    }
}
