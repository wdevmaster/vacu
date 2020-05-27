<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 13:16
 */

namespace Modules\Common\Resolvers;


use Illuminate\Support\Facades\DB;
use Modules\Sincronizacion\Entities\Traductor;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class GenerateCodeResolver implements GenerateCodeResolverInterface
{

    private $traductorRepository;

    public function __construct(TraductorRepository $traductorRepository)
    {
        $this->traductorRepository = $traductorRepository;
    }

    public function handle($user_code, $tabla)
    {
        try {
            $last_code = DB::select('select '.$tabla.'.code');
            $generate_code = random_int(1,1000);//TODO logica para generar el nuevo codigo
            /**
             * @var Traductor $traduccion
             */
            $traduccion = new Traductor();
            $traduccion->user_code = $user_code;
            $traduccion->generate_code = $generate_code;
            $traduccion->tabla = $tabla;

            $this->traductorRepository->create($traduccion->toArray());

        } catch (\Exception $e) {
        }
        return $generate_code;
    }
}
