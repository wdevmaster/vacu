<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:54
 */

namespace Modules\Enfermedad\Resolvers;


use Modules\Common\Resolvers\BaseResolver;
use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\Enfermedad\Entities\Enfermedad;
use Modules\Enfermedad\Repositories\EnfermedadRepository;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class SynEnfermedadesResolver extends BaseResolver implements SyncEnfermedadesResolverInterface
{

    /**
     * @var EnfermedadRepository
     */
    private $enfermedadRepository;


    public function __construct(EnfermedadRepository $enfermedadRepository,
                                GenerateCodeResolverInterface $generateCodeResolver,
                                TraductorRepository $traductorRepository)
    {
        parent::__construct($traductorRepository, $generateCodeResolver);
        $this->enfermedadRepository = $enfermedadRepository;

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
                $validateCode = $this->enfermedadRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['code'] = $code;
                $this->enfermedadRepository->create($data);
                break;

            case 'UPDATE':
                $enfermedad = $this->enfermedadRepository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($enfermedad)
                    $this->enfermedadRepository->update($data, $enfermedad->id);

                break;

            case 'DELETE':

                /**
                 * @var Enfermedad $enfermedad
                 */
                $enfermedad = $this->enfermedadRepository->all()
                    ->where('code', '=', $code)
                    ->first();
                if ($enfermedad) {
                    $this->enfermedadRepository->delete($enfermedad->id);
                }

                break;
        }
    }
}
