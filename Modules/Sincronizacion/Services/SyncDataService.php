<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 9:06
 */

namespace Modules\Sincronizacion\Services;


use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;

class SyncDataService implements SyncDataServiceInterface
{

    private $syncronizacionRepository;

    private $configuracionRepository;

    public function __construct(SyncronizacionRepository $syncronizacionRepository, ConfiguracionRepository $configuracionRepository)
    {
        $this->syncronizacionRepository = $syncronizacionRepository;
        $this->configuracionRepository = $configuracionRepository;
    }

    public function executeService()
    {
        try {
            $sincronizaciones = $this->syncronizacionRepository->all();

            if ($sincronizaciones) {

                foreach ($sincronizaciones as $sincronizacion) {
                    switch ($sincronizacion->tabla) {
                        case 'configuraciones':
                            $accion = $sincronizacion->accion;
                            switch ($accion) {
                                case 'INSERT':
                                    $data = json_decode($sincronizacion->data,true);
                                    $data['user_id'] = $sincronizacion->user_id;
                                    $this->configuracionRepository->create($data);
                                    break;
                                case 'UPDATE':
                                    $data = json_decode($sincronizacion->data, true);
                                    $configuracion = $this->configuracionRepository->all()
                                        ->where('clave', '=', $data['clave'])
                                        ->first();
                                    $this->configuracionRepository->update($data, $configuracion->id);
                                    break;
                                case 'DELETE':
                                    $data = json_decode($sincronizacion->data,true);
                                    $configuracion = $this->configuracionRepository->all()
                                        ->where('clave', '=', $data['clave'])
                                        ->first();
                                    $this->configuracionRepository->delete($configuracion->id);
                                    break;
                            }
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
