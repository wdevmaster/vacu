<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 12:33
 */

namespace Modules\Configuracion\Resolvers;


use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Sincronizacion\Entities\Syncronizacion;

class SyncConfiguracionResolver implements SyncConfiguracionResolverInterface
{
    private $configuracionRepository;

    public function __construct(ConfiguracionRepository $configuracionRepository)
    {
        $this->configuracionRepository = $configuracionRepository;
    }

    public function handle(Syncronizacion $sincronizacion)
    {
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
    }
}
