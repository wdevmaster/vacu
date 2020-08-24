<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 12/05/20
 * Time: 22:18
 */

namespace Modules\Common\Resolvers;


use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Bitacora\Entities\Bitacora;
use Modules\Bitacora\Repositories\BitacoraRepository;
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

    protected $bitacoraRepository;

    public function __construct(BitacoraRepository $bitacoraRepository,TraductorRepository $traductorRepository, GenerateCodeResolverInterface $generateCodeResolver,UserRepository $userRepo)
    {
        $this->traductorRepository = $traductorRepository;
        $this->generateCodeResolver = $generateCodeResolver;
        $this->userRepository = $userRepo;
        $this->bitacoraRepository = $bitacoraRepository;
    }

    public function handle(Syncronizacion $sincronizacion, BaseRepository $repository,$negocio_id)
    {


        $user_id=$sincronizacion->user_id;
        $accion = $sincronizacion->accion;
        $data = json_decode(json_decode($sincronizacion->data, true));
        $data = (array) $data;


        if(isset($data['code'])) {
            $code = $data['code'];
            $code_old = $data['code'];
            $data['negocio_id'] = $negocio_id;
            $traductor_code = $this->traductorRepository->all()->where('user_code', '=', $data['code'])->where('user_id', '=', $user_id)->where('negocio_id', '=', $negocio_id)->first();

            if ($traductor_code)
                $code = $traductor_code->generate_code;
        }

        switch ($accion) {
            case 'INSERT':
                $data['user_id'] = $sincronizacion->user_id;

                if (isset($data['code'])){
                    $validateCode = $repository->validateCode($code);
                    $fecha_actual=Carbon::now()->toDateTimeString();
                    if ($validateCode){
                        $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla,$negocio_id,$user_id);
                        if ($sincronizacion->tabla == 'animales'){
                            $bitacora= new Bitacora();
                            $bitacora->fecha_generacion= $fecha_actual;
                            $bitacora->code_usuario=$code_old;
                            $bitacora->code_generado= $code;
                            $bitacora->entidad='animales';
                            $bitacora->usuario_id=$user_id;

                            $this->bitacoraRepository->create($bitacora->toArray());

                        }

                    }

                    $data['code'] = $code;
                }

                $repository->create($data);
                break;

            case 'UPDATE':

                if(isset($data['code'])){
                    $model = $repository->all()
                        ->where('code', '=', $code)
                        ->first();
                }else{
                    $model = $repository->all()
                        ->where('id', '=', $data['id'])
                        ->first();
                }

                if ($model)
                    $repository->update($data, $model->id);

                break;

            case 'DELETE':

                if(isset($data['code']) && !is_null($data['code'])){
                    $model = $repository->all()
                        ->where('code', '=', $code)
                        ->first();
                    if ($model) {
                        if (isset($data['active'])){
                            $repository->delete_active_off($model->id);
                        }else{
                            try {
                                $repository->delete($model->id);
                            } catch (\Exception $e) {
                            }
                        }

                    }

                }else{
                    $model = $repository->all()
                        ->where('id', '=', $data['id'])
                        ->first();

                    if ($model) {
                        if (isset($data['active'])){
                            $repository->delete_active_off($model->id);
                        }else{
                            try {
                                $repository->delete($model->id);
                            } catch (\Exception $e) {
                            }
                        }
                    }
                }



                break;
        }
    }
}
