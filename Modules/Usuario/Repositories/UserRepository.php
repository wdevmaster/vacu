<?php

namespace Modules\Usuario\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\Usuario\Entities\User;
use phpseclib\Crypt\Hash;


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
}
