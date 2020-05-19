<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 9:06
 */

namespace Modules\Sincronizacion\Services;


use Modules\Animal\Entities\Animal;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Common\Resolvers\BaseResolver;
use Modules\CondicionCorporal\Entities\CondicionCorporal;
use Modules\CondicionCorporal\Repositories\CondicionCorporalRepository;
use Modules\Configuracion\Entities\Configuracion;
use Modules\Configuracion\Repositories\ConfiguracionRepository;
use Modules\Enfermedad\Entities\Enfermedad;
use Modules\Enfermedad\Repositories\EnfermedadRepository;
use Modules\EstadoFisico\Entities\EstadoFisico;
use Modules\EstadoFisico\Repositories\EstadoFisicoRepository;
use Modules\Evento\Entities\Evento;
use Modules\Evento\Repositories\EventoRepository;
use Modules\Finca\Entities\Finca;
use Modules\Finca\Repositories\FincaRepository;
use Modules\Negocio\Entities\Negocio;
use Modules\Negocio\Repositories\NegocioRepository;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;

class SyncDataService implements SyncDataServiceInterface
{

    /**
     * @var SyncronizacionRepository
     */
    private $syncronizacionRepository;

    /**
     * @var ConfiguracionRepository
     */
    private $configuracionRepository;


    /**
     * @var AnimalRepository
     */
    private $animalRepository;


    /**
     * @var CondicionCorporalRepository
     */
    private $condicionCorporalRepository;


    /**
     * @var EnfermedadRepository
     */
    private $enfermedadRepository;


    /**
     * @var NegocioRepository
     */
    private $negocioRepository;


    /**
     * @var EstadoFisicoRepository
     */
    private $estadoFisicoRepository;


    /**
     * @var EventoRepository
     */
    private $eventoRepository;


    private $fincaRepository;

    private $baseResolver;


    public function __construct(SyncronizacionRepository $syncronizacionRepository,
                                ConfiguracionRepository $configuracionRepository,
                                AnimalRepository $animalRepository,
                                CondicionCorporalRepository $condicionCorporalRepository,
                                EnfermedadRepository $enfermedadRepository,
                                NegocioRepository $negocioRepository,
                                EstadoFisicoRepository $estadoFisicoRepository,
                                EventoRepository $eventoRepository,
                                FincaRepository $fincaRepository,
                                BaseResolver $baseResolver
    )
    {
        $this->syncronizacionRepository = $syncronizacionRepository;


        $this->configuracionRepository = $configuracionRepository;


        $this->animalRepository = $animalRepository;


        $this->condicionCorporalRepository = $condicionCorporalRepository;


        $this->enfermedadRepository = $enfermedadRepository;


        $this->negocioRepository = $negocioRepository;


        $this->estadoFisicoRepository = $estadoFisicoRepository;


        $this->eventoRepository = $eventoRepository;


        $this->fincaRepository = $fincaRepository;

        $this->baseResolver = $baseResolver;

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function executeService(): array
    {

        $sincronizaciones = $this->syncronizacionRepository->all();
        $results = array();

        if ($sincronizaciones) {

            foreach ($sincronizaciones as $sincronizacion) {
                switch ($sincronizacion->tabla) {

                    case Configuracion::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->configuracionRepository);
                        break;

                    case Animal::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->animalRepository);
                        break;

                    case CondicionCorporal::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->condicionCorporalRepository);
                        break;

                    case Enfermedad::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->enfermedadRepository);
                        break;

                    case Negocio::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->negocioRepository);
                        break;

                    case EstadoFisico::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->estadoFisicoRepository);
                        break;

                    case Evento::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->eventoRepository);
                        break;

                    case Finca::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->fincaRepository);
                        break;

//                    case Ingreso::$tableName:
//                        $this->syncIngresoResolver->handle($sincronizacion);
//                        break;
//                    case Inseminador::$tableName:
//                        $this->syncInseminadorResolver->handle($sincronizacion);
//                        break;
//
//                    case Lactancia::$tableName:
//                        $this->syncLactanciaResolver->handle($sincronizacion);
//                        break;
//
//                    case Locomocion::$tableName:
//                        $this->syncLocomocionResolver->handle($sincronizacion);
//                        break;
//
//                    case Lote::$tableName:
//                        $this->syncLoteResolver->handle($sincronizacion);
//                        break;
//
//                    case Muerte::$tableName:
//                        $this->syncMuerteResolver->handle($sincronizacion);
//                        break;
//
//                    case Parto::$tableName:
//                        $this->syncPartoResolver->handle($sincronizacion);
//                        break;
//
//                    case Produccion::$tableName:
//                        $this->syncProduccionResolver->handle($sincronizacion);
//                        break;
//
//                    case Raza::$tableName:
//                        $this->syncRazaResolver->handle($sincronizacion);
//                        break;
//
//                    case RegistroEnfermedad::$tableName:
//                        $this->syncNegocioResolver->handle($sincronizacion);
//                        break;
//
//                    case Semen::$tableName:
//                        $this->syncSemenResolver->handle($sincronizacion);
//                        break;
//
//                    case Servicio::$tableName:
//                        $this->syncServicioResolver->handle($sincronizacion);
//                        break;
//
//                    case TipoServicio::$tableName:
//                        $this->syncTipoServicioResolver->handle($sincronizacion);
//                        break;
//
//                    case Venta::$tableName:
//                        $this->syncVentaResolver->handle($sincronizacion);
//                        break;

                }
                $this->syncronizacionRepository->delete($sincronizacion->id);
            }
        }
        $results['configuraciones'] = $this->configuracionRepository->all();
        $results['animales'] = $this->animalRepository->all();
        $results['condiciones_corporales'] = $this->condicionCorporalRepository->all();
        $results['enfermedades'] = $this->enfermedadRepository->all();
        $results['negocios'] = $this->negocioRepository->all();
        $results['estados_fisicos'] = $this->estadoFisicoRepository->all();
        $results['eventos'] = $this->eventoRepository->all();
        $results['fincas'] = $this->eventoRepository->all();

        return $results;


    }
}
