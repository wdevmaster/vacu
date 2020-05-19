<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:54
 */

namespace Modules\EstadoFisico\Resolvers;



use Modules\Animal\Entities\Animal;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Common\Resolvers\BaseResolver;
use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\EstadoFisico\Entities\EstadoFisico;
use Modules\EstadoFisico\Repositories\EstadoFisicoRepository;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class SynEstadoFisicoResolver extends BaseResolver implements SyncEstadoFisicoResolverInterface
{

    /**
     * @var EstadoFisicoRepository
     */
    private $estadoFisicoRepository;


    public function __construct(EstadoFisicoRepository $estadoFisicoRepository,
                                GenerateCodeResolverInterface $generateCodeResolver,
                                TraductorRepository $traductorRepository)
    {
        parent::__construct($traductorRepository, $generateCodeResolver);
        $this->estadoFisicoRepository = $estadoFisicoRepository;

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
                $validateCode = $this->estadoFisicoRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['code'] = $code;
                $this->estadoFisicoRepository->create($data);
                break;

            case 'UPDATE':
                $estado_fisico = $this->estadoFisicoRepository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($estado_fisico)
                    $this->estadoFisicoRepository->update($data, $estado_fisico->id);

                break;

            case 'DELETE':

                /**
                 * @var EstadoFisico $estado_fisico
                 */
                $estado_fisico = $this->estadoFisicoRepository->all()
                    ->where('code', '=', $code)
                    ->first();
                if ($estado_fisico) {
                    $this->estadoFisicoRepository->delete($estado_fisico->id);
                }

                break;
        }
    }
}
