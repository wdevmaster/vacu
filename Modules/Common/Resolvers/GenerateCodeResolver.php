<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 13:16
 */

namespace Modules\Common\Resolvers;


use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Bitacora\Repositories\BitacoraRepository;
use Modules\Sincronizacion\Entities\Traductor;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class GenerateCodeResolver implements GenerateCodeResolverInterface
{

    private $traductorRepository;

    public function __construct(TraductorRepository $traductorRepository)
    {
        $this->traductorRepository = $traductorRepository;

    }

    public function handle($user_code, $tabla,$negocio_id,$user_id)
    {
        try {

            $codes = DB::table($tabla)->select('code')->get();
            $mayor = 0;
            if (count($codes) > 0){
                foreach ($codes as $code){
                    if ($code->code > $mayor){
                        $mayor = $code->code;
                    }
                }
                $mayor = $mayor + 1;
            } else {
                $mayor= 1;
            }

            $generate_code = $mayor;
            /**
             * @var Traductor $traduccion
             */
            $traduccion = new Traductor();
            $traduccion->user_id = $user_id;
            $traduccion->user_code = $user_code;
            $traduccion->generate_code = $generate_code;
            $traduccion->negocio_id = $negocio_id;
            $traduccion->tabla = $tabla;

            $this->traductorRepository->create($traduccion->toArray());

        } catch (\Exception $e) {
        }
        return $generate_code;
    }
}
