<?php

namespace Modules\Animal\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use Modules\Animal\Entities\Animal;
use Modules\Animal\Exports\AnimalExport;
use Modules\Animal\Http\Requests\CreateAnimalAPIRequest;
use Modules\Animal\Http\Requests\UpdateAnimalAPIRequest;
use Modules\Animal\Imports\AnimalImport;
use Modules\Animal\Repositories\AnimalRepository;
use Modules\Common\Http\Controllers\CommonController;
use Modules\Negocio\Repositories\NegocioRepository;

/**
 * Class AnimalController
 * @package Modules\Animal\Http\Controllers
 */
class AnimalAPIController extends CommonController
{
    /** @var  AnimalRepository */
    private $animalRepository;

    /**
     * @var Excel
     */
    private $excel;

    private $negocioRepository;

    public function __construct(AnimalRepository $animalRepo, Excel $excel, NegocioRepository $negocioRepo)
    {
        $this->animalRepository = $animalRepo;
        $this->excel = $excel;
        $this->negocioRepository= $negocioRepo;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Get(
     *      path="/api/v1/animal/animales",
     *      summary="Get a listing of the Animals.",
     *      tags={"Animal"},
     *      description="Get all Animals",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="paginado",
     *          in="query",
     *          type="integer",
     *          description="Paginado",
     *          required=false,
     *          @SWG\Schema(
     *               @SWG\Property(
     *                  property="paginate",
     *                  type="integer"
     *              ),
     *         )
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Animal")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *    security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function index(Request $request)
    {
        try {

            $paginate = isset($request->paginado) ? $request->paginado : null;

            if ($paginate) {
                $animals = $this->animalRepository->paginate($paginate);
            } else {
                $animals = $this->animalRepository->all(
                    $request->except(['skip', 'limit']),
                    $request->get('skip'),
                    $request->get('limit')
                );
            }


            return $this->sendResponse($animals->toArray(),
                'comun::msgs.la_model_list_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }

    }

    /**
     * @param CreateAnimalAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/animal/animales",
     *      summary="Store a newly created Animal in storage",
     *      tags={"Animal"},
     *      description="Store Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Animal that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Animal")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Animal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function store(CreateAnimalAPIRequest $request)
    {
        try {
            $input = $request->all();
            $codigo_trabajo=$input['codigo_trabajo'];
            $animal_codigo_existe=$this->animalRepository->all()->where('codigo_trabajo','=',$codigo_trabajo)->first();

            if($animal_codigo_existe){
                return $this->sendResponse([],
                    'Exist the Work Code',
                    false,
                    404);
            }

            $animal = $this->animalRepository->create($input);

            return $this->sendResponse($animal->toArray(),
                'comun::msgs.la_model_saved_successfully',
                true,
                201);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }


    /**
     * @param int $id
     * @param UpdateAnimalAPIRequest $request
     * @return JsonResponse
     *
     * @SWG\Put(
     *      path="/api/v1/animal/animales/{id}",
     *      summary="Update the specified Animal in storage",
     *      tags={"Animal"},
     *      description="Update Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Animal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Animal that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Animal")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Animal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function update($id, UpdateAnimalAPIRequest $request)
    {
        try {
            $input = $request->all();
            $codigo_trabajo=$input['codigo_trabajo'];
            $animal_codigo_existe=$this->animalRepository->all()->where('codigo_trabajo','=',$codigo_trabajo)->first();

            if($animal_codigo_existe){
                return $this->sendResponse([],
                    'Exist the Work Code',
                    false,
                    404);
            }

            $animal = $this->animalRepository->update($input, $id);

            return $this->sendResponse($animal->toArray(),
                'comun::msgs.la_model_updated_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     *
     * @SWG\Delete(
     *      path="/api/v1/animal/animales/{id}",
     *      summary="Remove the specified Animal from storage",
     *      tags={"Animal"},
     *      description="Delete Animal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Animal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *    security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function destroy($id)
    {
        try {
            /** @var Animal $animal */
            $animal = $this->animalRepository->find($id);

            $animal->active = false;
            $result = $this->animalRepository->update($animal->toArray(), $animal->id);

            return $this->sendResponse($result->toArray(),
                'comun::msgs.la_model_desactivated_successfully',
                true,
                200);

        } catch (ModelNotFoundException $e) {
            return $this->sendResponse([],
                'comun::msgs.la_model_not_found',
                false,
                404);
        } catch
        (\Exception $e) {

            return $this->sendResponse([],
                'comun::msgs.msg_error_contact_the_administrator',
                false,
                500);
        }
    }


    /**
     * @param $negocio_id
     * @param Request $request
     * @return JsonResponse
     *
     * @SWG\Post(
     *      path="/api/v1/animal/animales/import/{negocio_id}",
     *      summary="Import Excel",
     *      tags={"Excel"},
     *      description="Import Excel",
     *      consumes={"multipart/form-data"},
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="file",
     *          in="formData",
     *          description="File Excel to Import",
     *          required=true,
     *          type="file"
     *
     *      ),
     *     @SWG\Parameter(
     *          name="negocio_id",
     *          description="id of negocio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function importAnimales($negocio_id, Request $request)
    {

        try {
            $negocio= $this->negocioRepository->find($negocio_id)->first();
            $fecha_creacion = $negocio->first()->fecha_creacion;
            if($fecha_creacion==null){
                return $this->sendResponse([],
                    'Su negocio no tiene Fecha de Creación no se puede importar el excel',
                    false);
            }

            $this->validate($request, [
                'file' => 'required|mimes:xls,xlsx'
            ]);
            $path1 = $request->file('file')->store('temp');
            $path = storage_path('app') . '/' . $path1;
            $data = $this->excel->import(new AnimalImport($negocio_id), $path);


            return $this->sendResponse($data,
                'File imported successfully',
                true,
                200);
        } catch (ModelNotFoundException $e) {
                return $this->sendResponse([],
                    'comun::msgs.la_model_not_found',
                    false,
                    404);
        }
            catch (\Exception $exception) {
                return $this->sendResponse([],
                    $exception->getMessage(),
                    false,
                    500);
        }

    }



    /**
     * @param $negocio_id
     * @param Request $request
     * @return Excel
     *
     * @SWG\Get(
     *      path="/api/v1/animal/animales/export/{negocio_id}",
     *      summary="Export Excel",
     *      tags={"Excel"},
     *      description="Export Excel",
     *      consumes={"multipart/form-data"},
     *      produces={"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"},
     *    @SWG\Parameter(
     *          name="negocio_id",
     *          description="id of negocio",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="file",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      ),
     *      security={
     *      {"Bearer": {}}
     *    }
     * )
     */
    public function exportAnimales($negocio_id)
    {

        try {
             $fileName = 'Inventario.xlsx';
             $writerType = Excel::XLSX;
            $animalExport=new AnimalExport($negocio_id);
            return $this->excel->download($animalExport,$fileName,$writerType,$animalExport->headings());

        }
        catch (\Exception $exception) {
            return $this->sendResponse([],
                $exception->getMessage(),
                false,
                500);
        }

    }

}
