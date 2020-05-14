<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:54
 */

namespace Modules\Negocio\Resolvers;



use Modules\Negocio\Entities\Negocio;
use Modules\Negocio\Repositories\NegocioRepository;
use Modules\Common\Resolvers\BaseResolver;
use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class SyncNegocioResolver extends BaseResolver implements SyncNegocioResolverInterface
{

    /**
     * @var NegocioRepository
     */
    private $negocioRepository;


    public function __construct(NegocioRepository $negocioRepository,
                                GenerateCodeResolverInterface $generateCodeResolver,
                                TraductorRepository $traductorRepository)
    {
        parent::__construct($traductorRepository, $generateCodeResolver);
        $this->negocioRepository = $negocioRepository;

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
                $validateCode = $this->negocioRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['code'] = $code;
                $this->negocioRepository->create($data);
                break;

            case 'UPDATE':
                $negocio = $this->negocioRepository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($negocio)
                    $this->negocioRepository->update($data, $negocio->id);

                break;

            case 'DELETE':

                /**
                 * @var Negocio $negocio
                 */
                $negocio = $this->negocioRepository->all()
                    ->where('code', '=', $code)
                    ->first();
                if ($negocio) {
                    $this->negocioRepository->delete($negocio->id);
                }

                break;
        }
    }
}
