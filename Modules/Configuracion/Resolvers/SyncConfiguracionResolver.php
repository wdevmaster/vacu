<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 12:33
 */

namespace Modules\Configuracion\Resolvers;


use Modules\Common\Resolvers\BaseResolver;
use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class SyncConfiguracionResolver extends BaseResolver implements SyncConfiguracionResolverInterface
{
    /**
     * @var ConfiguracionRepository
     */
    private $configuracionRepository;


    public function __construct(ConfiguracionRepository $configuracionRepository,
                                GenerateCodeResolverInterface $generateCodeResolver,
                                TraductorRepository $traductorRepository)
    {
        parent::__construct($traductorRepository, $generateCodeResolver);
        $this->configuracionRepository = $configuracionRepository;

    }

    public function handle(Syncronizacion $sincronizacion)
    {
        $accion = $sincronizacion->accion;
        $data = json_decode($sincronizacion->data, true);
        $code = $data['code'];
        $traductor_code = $this->traductorRepository->all()->where('user_code', '=', $data['code'])->first();

        if ($traductor_code)
            $code = $traductor_code->generate_code;

        switch ($accion) {
            case 'INSERT':
                $data['user_id'] = $sincronizacion->user_id;
                $data['active'] = true;
                $validateCode = $this->configuracionRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['code'] = $code;
                $this->configuracionRepository->create($data);
                break;

            case 'UPDATE':
                $configuracion = $this->configuracionRepository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($configuracion)
                    $this->configuracionRepository->update($data, $configuracion->id);

                break;

            case 'DELETE':

                /**
                 * @var Configuracion $configuracion
                 */
                $configuracion = $this->configuracionRepository->all()
                    ->where('code', '=', $code)
                    ->first();
                if ($configuracion) {
                    $this->configuracionRepository->delete($configuracion->id);
                }

                break;
        }
    }
}
