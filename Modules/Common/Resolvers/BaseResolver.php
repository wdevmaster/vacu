<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 12/05/20
 * Time: 22:18
 */

namespace Modules\Common\Resolvers;


use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;
use Modules\Usuario\Repositories\UserRepository;
use phpDocumentor\Reflection\Types\Integer;

class BaseResolver
{
    /**
     * @var TraductorRepository
     */
    protected $traductorRepository;

    protected $generateCodeResolver;

    protected $userRepository;

    public function __construct(TraductorRepository $traductorRepository, GenerateCodeResolverInterface $generateCodeResolver,UserRepository $userRepo)
    {
        $this->traductorRepository = $traductorRepository;
        $this->generateCodeResolver = $generateCodeResolver;
        $this->userRepository = $userRepo;
    }

    public function handle(Syncronizacion $sincronizacion, BaseRepository $repository)
    {


        $user_id=$sincronizacion->user_id;
        $user = $this->userRepository->find($user_id);
        $negocio_id=$user->negocio_id;
        $accion = $sincronizacion->accion;
        $data = json_decode($sincronizacion->data, true);
        $code = $data['code'];
        $traductor_code = $this->traductorRepository->all()->where('user_code', '=', $data['code'])->where('user_id','=',$user_id)->where('negocio_id','=',$negocio_id)->first();

        if ($traductor_code)
            $code = $traductor_code->generate_code;

        switch ($accion) {
            case 'INSERT':
                $data['user_id'] = $sincronizacion->user_id;
                $validateCode = $repository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla,$negocio_id);

                $data['code'] = $code;
                $repository->create($data);
                break;

            case 'UPDATE':
                $model = $repository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($model)
                    $repository->update($data, $model->id);

                break;

            case 'DELETE':

                /**
                 * @var Model $model
                 */
                $model = $repository->all()
                    ->where('code', '=', $code)
                    ->first();
                if ($model) {
                    $repository->delete($model->id);
                }

                break;
        }
    }
}
