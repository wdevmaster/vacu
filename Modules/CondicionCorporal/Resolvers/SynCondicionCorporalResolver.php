<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 12/05/20
 * Time: 22:14
 */

namespace Modules\CondicionCorporal\Resolvers;


use Modules\Common\Resolvers\BaseResolver;
use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Modules\CondicionCorporal\Repositories\CondicionCorporalRepository;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class SynCondicionCorporalResolver extends BaseResolver implements SynCondicionCorporalResolverInterface
{

    private $condicionCorporalRepository;

    public function __construct(TraductorRepository $traductorRepository, GenerateCodeResolverInterface $generateCodeResolver, CondicionCorporalRepository $condicionCorporalRepository)
    {
        parent::__construct($traductorRepository, $generateCodeResolver);
        $this->condicionCorporalRepository = $condicionCorporalRepository;
    }

    /**
     * @param Syncronizacion $sincronizacion
     * @throws \Exception
     */
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
                $validateCode = $this->condicionCorporalRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['code'] = $code;
                $this->condicionCorporalRepository->create($data);
                break;

            case 'UPDATE':
                $condicion_corporal = $this->condicionCorporalRepository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($condicion_corporal)
                    $this->condicionCorporalRepository->update($data, $condicion_corporal->id);

                break;

            case 'DELETE':

                /**
                 * @var CondicionCorporal $condicion_corporal
                 */
                $condicion_corporal = $this->condicionCorporalRepository->all()
                    ->where('code', '=', $code)
                    ->first();
                if ($condicion_corporal) {
                    $this->condicionCorporalRepository->delete( $condicion_corporal->id);
                }

                break;
        }
    }
}
