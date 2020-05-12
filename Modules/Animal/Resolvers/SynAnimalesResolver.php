<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:54
 */

namespace Modules\Animal\Resolvers;



use Modules\Animal\Entities\Animal;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Common\Resolvers\GenerateCodeResolverInterface;
use Modules\Sincronizacion\Entities\Syncronizacion;
use Modules\Sincronizacion\Repositories\TraductorRepository;

class SynAnimalesResolver implements SyncAnimalesResolverInterface
{

    /**
     * @var AnimalRepository
     */
    private $animalRepository;

    /**
     * @var GenerateCodeResolverInterface
     */
    private $generateCodeResolver;

    /**
     * @var TraductorRepository
     */
    private $traductorRepository;

    public function __construct(AnimalRepository $animalRepository,
                                GenerateCodeResolverInterface $generateCodeResolver,
                                TraductorRepository $traductorRepository)
    {
        $this->animalRepository = $animalRepository;
        $this->generateCodeResolver = $generateCodeResolver;
        $this->traductorRepository = $traductorRepository;
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
                $validateCode = $this->animalRepository->validateCode($code);

                if ($validateCode)
                    $code = $this->generateCodeResolver->handle($code, $sincronizacion->tabla);

                $data['code'] = $code;
                $this->animalRepository->create($data);
                break;

            case 'UPDATE':
                $animal = $this->animalRepository->all()
                    ->where('code', '=', $code)
                    ->first();

                if ($animal)
                    $this->animalRepository->update($data, $animal->id);

                break;

            case 'DELETE':

                /**
                 * @var Animal $animal
                 */
                $animal = $this->animalRepository->all()
                    ->where('code', '=', $data['code'])
                    ->first();
                if ($animal) {
                    $animal->active = false;
                    $this->animalRepository->update($animal->toArray(), $animal->id);
                }

                break;
        }
    }
}
