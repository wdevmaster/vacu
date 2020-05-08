<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 9:06
 */

namespace Modules\Sincronizacion\Services;


use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Configuracion\Resolvers\SyncConfiguracionResolverInterface;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;

class SyncDataService implements SyncDataServiceInterface
{

    private $syncronizacionRepository;

    private $configuracionResolver;

    public function __construct(SyncronizacionRepository $syncronizacionRepository,
                                SyncConfiguracionResolverInterface $configuracionResolver)
    {
        $this->syncronizacionRepository = $syncronizacionRepository;
        $this->configuracionResolver = $configuracionResolver;
    }

    public function executeService()
    {
        try {
            $sincronizaciones = $this->syncronizacionRepository->all();

            if ($sincronizaciones) {

                foreach ($sincronizaciones as $sincronizacion) {
                    switch ($sincronizacion->tabla) {
                        case 'configuraciones':
                            $this->configuracionResolver->handle($sincronizacion);
                            $this->syncronizacionRepository->delete($sincronizacion->id);
                            break;
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => __('comun::msgs.msg_error_contact_the_administrator'),
                'success' => false
            ], 500);
        }


    }
}
