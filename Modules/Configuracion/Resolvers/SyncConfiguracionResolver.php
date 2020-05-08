<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 12:33
 */

namespace Modules\Configuracion\Resolvers;


use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Sincronizacion\Entities\Syncronizacion;

class SyncConfiguracionResolver implements SyncConfiguracionResolverInterface
{
    /**
     * @var ConfiguracionRepository
     */
    private $configuracionRepository;

    /**
     * @var GenerateCodeResolverInterface
     */
    private $generateCodeResolver;

    public function __construct(ConfiguracionRepository $configuracionRepository,
                                GenerateCodeResolverInterface $generateCodeResolver)
    {
        $this->configuracionRepository = $configuracionRepository;
        $this->generateCodeResolver = $generateCodeResolver;
    }

    public function handle(Syncronizacion $sincronizacion)
    {
        $accion = $sincronizacion->accion;
        switch ($accion) {
            case 'INSERT':
                $data = json_decode($sincronizacion->data,true);
                $data['user_id'] = $sincronizacion->user_id;
                $code = $data['clave'];

                $validateCode = $this->configuracionRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['clave'] = $code;

                $this->configuracionRepository->create($data);
                break;
            case 'UPDATE':
                $data = json_decode($sincronizacion->data, true);
                $configuracion = $this->configuracionRepository->all()
                    ->where('clave', '=', $data['clave'])
                    ->first();
                if ($configuracion)
                $this->configuracionRepository->update($data, $configuracion->id);
                break;
            case 'DELETE':
                $data = json_decode($sincronizacion->data,true);
                $configuracion = $this->configuracionRepository->all()
                    ->where('clave', '=', $data['clave'])
                    ->first();
                if ($configuracion)
                $this->configuracionRepository->delete($configuracion->id);
                break;
        }
    }
}
