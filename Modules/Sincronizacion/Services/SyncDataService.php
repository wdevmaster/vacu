<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 9:06
 */

namespace Modules\Sincronizacion\Services;


use Illuminate\Support\Facades\Auth;
use Modules\Animal\Entities\Animal;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Bitacora\Repositories\BitacoraRepository;
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
use Modules\Ingreso\Entities\Ingreso;
use Modules\Ingreso\Repositories\IngresoRepository;
use Modules\Inseminador\Entities\Inseminador;
use Modules\Inseminador\Repositories\InseminadorRepository;
use Modules\Lactancia\Entities\Lactancia;
use Modules\Lactancia\Repositories\LactanciaRepository;
use Modules\Locomocion\Entities\Locomocion;
use Modules\Locomocion\Repositories\LocomocionRepository;
use Modules\Lote\Entities\Lote;
use Modules\Lote\Repositories\LoteRepository;
use Modules\Muerte\Entities\Muerte;
use Modules\Muerte\Repositories\MuerteRepository;
use Modules\Negocio\Entities\Negocio;
use Modules\Negocio\Repositories\NegocioRepository;
use Modules\Parto\Entities\Parto;
use Modules\Parto\Repositories\PartoRepository;
use Modules\Produccion\Entities\Produccion;
use Modules\Produccion\Repositories\ProduccionRepository;
use Modules\Raza\Entities\Raza;
use Modules\Raza\Repositories\RazaRepository;
use Modules\RegistroEnfermedad\Entities\RegistroEnfermedad;
use Modules\RegistroEnfermedad\Repositories\RegistroEnfermedadRepository;
use Modules\Semen\Entities\Semen;
use Modules\Semen\Repositories\SemenRepository;
use Modules\Servicio\Entities\Servicio;
use Modules\Servicio\Repositories\ServicioRepository;
use Modules\Sincronizacion\Repositories\SyncronizacionRepository;
use Modules\TipoServicio\Entities\TipoServicio;
use Modules\TipoServicio\Repositories\TipoServicioRepository;
use Modules\Usuario\Entities\RolApk;
use Modules\Usuario\Entities\RolBoton;
use Modules\Usuario\Repositories\RolApkRepository;
use Modules\Usuario\Repositories\RolBotonRepository;
use Modules\Venta\Entities\Venta;
use Modules\Venta\Repositories\VentaRepository;

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

    private $ingresoRepository;

    private $inseminadorRepository;

    private $lactanciaRepository;

    private $locomocionRepository;

    private $loteRepository;

    private $muerteRepository;

    private $partoRepository;

    private $produccionRepository;

    private $razaRepository;

    private $registroEnfermedadRepository;

    private $semenRepository;

    private $servicioRepository;

    private $tipoServicioRepository;

    private $ventaRepository;

    private $rolApkRepository;

    private $rolBotonRepository;

    private $bitacoraRepository;

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
                                IngresoRepository $ingresoRepository,
                                InseminadorRepository $inseminadorRepository,
                                LactanciaRepository $lactanciaRepository,
                                LocomocionRepository $locomocionRepository,
                                LoteRepository $loteRepository,
                                MuerteRepository $muerteRepository,
                                PartoRepository $partoRepository,
                                ProduccionRepository $produccionRepository,
                                RazaRepository $razaRepository,
                                RegistroEnfermedadRepository $registroEnfermedadRepository,
                                SemenRepository $semenRepository,
                                ServicioRepository $servicioRepository,
                                TipoServicioRepository $tipoServicioRepository,
                                VentaRepository $ventaRepository,
                                RolApkRepository $rolApkRepository,
                                RolBotonRepository $rolBotonRepository,
                                BitacoraRepository $bitacoraRepository,
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
        $this->ingresoRepository = $ingresoRepository;
        $this->inseminadorRepository = $inseminadorRepository;
        $this->lactanciaRepository = $lactanciaRepository;
        $this->locomocionRepository = $locomocionRepository;
        $this->loteRepository = $loteRepository;
        $this->muerteRepository = $muerteRepository;
        $this->partoRepository = $partoRepository;
        $this->produccionRepository = $produccionRepository;
        $this->razaRepository = $razaRepository;
        $this->registroEnfermedadRepository = $registroEnfermedadRepository;
        $this->semenRepository = $semenRepository;
        $this->servicioRepository = $servicioRepository;
        $this->tipoServicioRepository = $tipoServicioRepository;
        $this->ventaRepository = $ventaRepository;
        $this->rolApkRepository = $rolApkRepository;
        $this->rolBotonRepository = $rolBotonRepository;
        $this->bitacoraRepository = $bitacoraRepository;

        $this->baseResolver = $baseResolver;

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function executeService(): array
    {

        $user = Auth::user();
        $negocio_id=$user->negocio_id;
        $sincronizaciones = $this->syncronizacionRepository->all()->where('user_id', '=', $user->id);
        $results = array();


        if ($sincronizaciones) {

            foreach ($sincronizaciones as $sincronizacion) {
                switch ($sincronizacion->tabla) {

                    case Configuracion::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->configuracionRepository);
                        break;

                    case Animal::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->animalRepository );
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

                    case Ingreso::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->ingresoRepository);
                        break;
                    case Inseminador::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->inseminadorRepository);
                        break;

                    case Lactancia::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->lactanciaRepository);
                        break;

                    case Locomocion::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->locomocionRepository);
                        break;

                    case Lote::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->loteRepository);
                        break;

                    case Muerte::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->muerteRepository);
                        break;

                    case Parto::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->partoRepository);
                        break;

                    case Produccion::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->produccionRepository);
                        break;

                    case Raza::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->razaRepository);
                        break;

                    case RegistroEnfermedad::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->registroEnfermedadRepository);
                        break;

                    case Semen::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->semenRepository);
                        break;

                    case Servicio::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->servicioRepository);
                        break;

                    case TipoServicio::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->tipoServicioRepository);
                        break;

                    case Venta::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->ventaRepository);
                        break;

                    case RolApk::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->rolApkRepository);
                        break;

                    case RolBoton::$tableName:
                        $this->baseResolver->handle($sincronizacion, $this->rolBotonRepository);
                        break;

                }
                $this->syncronizacionRepository->delete($sincronizacion->id);
            }
        }
        $results['configuraciones'] = $this->configuracionRepository->all();
        $results['animales'] = $this->animalRepository->all();
        $results['condiciones_corporales'] = $this->condicionCorporalRepository->all()->where('negocio_id','=',$negocio_id);
        $results['enfermedades'] = $this->enfermedadRepository->all()->where('negocio_id','=',$negocio_id);
        $results['negocios'] = $this->negocioRepository->all();
        $results['estados_fisicos'] = $this->estadoFisicoRepository->all();
        $results['eventos'] = $this->eventoRepository->all();
        $results['fincas'] = $this->fincaRepository->all()->where('negocio_id','=',$negocio_id);
        $results['ingresos'] = $this->ingresoRepository->all();
        $results['inseminadores'] = $this->inseminadorRepository->all()->where('negocio_id','=',$negocio_id);
        $results['lactancias'] = $this->lactanciaRepository->all();
        $results['locomociones'] = $this->locomocionRepository->all()->where('negocio_id','=',$negocio_id);
        $results['lotes'] = $this->loteRepository->all();
        $results['muertes'] = $this->muerteRepository->all();
        $results['partos'] = $this->partoRepository->all();
        $results['producciones'] = $this->produccionRepository->all();
        $results['razas'] = $this->razaRepository->all()->where('negocio_id','=',$negocio_id);
        $results['registros_enfermedades'] = $this->registroEnfermedadRepository->all();
        $results['semens'] = $this->semenRepository->all();
        $results['registros_enfermedades'] = $this->registroEnfermedadRepository->all();
        $results['servicios'] = $this->servicioRepository->all();
        $results['tipos_servicios'] = $this->tipoServicioRepository->all();
        $results['ventas'] = $this->ventaRepository->all();
        $results['rol_apks'] = $this->rolApkRepository->all();
        $results['rol_botons'] = $this->rolApkRepository->all();
        $results['bitacoras'] = $this->bitacoraRepository->all()->where('usuario_id','=',$user->id);


        return $results;


    }
}
