<?php

namespace Modules\Usuario\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\Usuario\Entities\User;


/**
 * Class UserRepository
 * @package Modules\Usuario\Repositories
 * @version May 1, 2020, 12:57 pm UTC
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'negocioId',
        'fincaId'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function filterByNegocioId($filter, $orderBy, $direction, $paginate)
    {
        $query = DB::table('users')
            ->select(['users.*'])
            ->join('negocios', 'users.negocio_id', '=', 'negocios.id');

        $filter_new = null;
        $exist_id = existFieldInFilter('id', $filter, $val_id);

        if ($exist_id) {
            foreach ($filter as $filterField => $val) {
                if ($val[0] != 'id') {
                    $filter_new[] = $val;
                }
            }
            $query->where('negocios.id', '=', $val_id);
        }

        $query = buildFilterQuery($filter_new, $query, $orderBy, $direction);
        $results = $query->paginate($paginate);

        return $results;
    }


    public function create($input)
    {
        $password = Hash::make($input['password']);
        $input['password'] = $password;

        return parent::create($input);
    }


    public function update($input, $id)
    {
        $password = Hash::make($input['password']);
        $input['password'] = $password;
        return parent::update($input, $id);
    }

    public function paginate($perPage, $columns = ['*'])
    {

        $query = $this->allQuery()->where('email', '!=', 'apk@test.com');

        return $query->paginate($perPage, $columns);

    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {

        $query = $this->allQuery($search, $skip, $limit)->where('email', '!=', 'apk@test.com');

        return $query->get($columns);

    }

    public function allUsersSync($negocio_id){
        $query = $this->allQuery()->where('negocio_id', '=', $negocio_id);

        return $query->get();
    }
}
