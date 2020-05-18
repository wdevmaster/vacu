<?php

if (!function_exists('buildFilterQuery')) {
    /**
     * Build a query based in the params send from the view.
     *
     * @param mixed $filters
     * @param Illuminate\Database\Query $query
     * @return Illuminate\Database\Query
     */
    function buildFilterQuery($filters, $query, $orderBy = 'id', $direction = 'asc')
    {
        if (is_array($filters)) {
            foreach ($filters as $field => $val) {

                /*
                 * pitfall for raw query
                 */
                if (is_array($val)) {
                    list($field, $operator, $value) = $val;
                } elseif (is_object($val)) {
                    $field = $val->field;
                    $operator = $val->operator;
                    $value = $val->value;
                }

                /*
                 * pitfall for operator
                 */
                switch ($operator) {
                    case 'is_null':
                        $query->whereNull($field);
                        break;
                    case 'not_null':
                        $query->whereNotNull($field);
                        break;
                    case 'in':
                        $query->whereIn($field, $value);
                        break;
                    case 'not_in':
                        $query->whereNotIn($field, $value);
                        break;
                    case 'between':
                        $query->whereBetween($field, $value);
                        break;
                    case 'like':
                        $query->where($field, 'like', "%$value%");
                        break;
                    default:
                        $query = $query->where($field, $operator, $value);
                        break;
                }
            }
        }

        $query->orderBy($orderBy, $direction);

        return $query;
    }
}

/**
 * @param $field
 * @param $filter
 * @param $value
 * @return bool
 */
function existFieldInFilter($field, $filter, &$value)
{
    foreach ($filter as $filterField => $val) {
        if (is_array($val)) {
            if (array_key_exists('field', $val)) {
                if ($val['field'] == $field) {
                    $value = $val['value'];
                    return true;
                }
            } else {
                if ($val[0] == $field) {
                    $value = $val[2];
                    return true;
                }
            }
        } elseif (is_object($val)) {
            if ($val->field == $field) {
                $value = $val->value;
                return true;
            }
        }
    }

    $value = false;
    return false;
}

/**
 * @param $field
 * @param $filter
 * @param $value
 * @return bool
 */
function updateFieldInFilter($field, &$filter, $value)
{

    foreach ($filter as $filterField => &$val) {
        if (is_array($val)) {

            if (array_key_exists('field', $val)) {
                if ($val['field'] == $field) {
                    $val['value'] = $value;
                    return true;
                }
            } else {
                if ($val[0] == $field) {
                    $val[2] = $value;
                }
            }
        } elseif (is_object($val)) {
            if ($val->field == $field) {
                $val->value = $value;
            }
        }
    }
}

function extractValidationDataFromFilter($rulesFields, $filter)
{
    if (!is_array($filter)) {
        $filter = [];
    }

    $validationData = [];
    foreach ($rulesFields as $rField) {
        $existFieldInFilter = existFieldInFilter($rField, $filter, $value);
        if ($existFieldInFilter) {
            $validationData[$rField] = $value;
        }
    }

    return $validationData;
}

function objectToArray($d)
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}

function arrayToObject($d)
{
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return (object)array_map(__FUNCTION__, $d);
    } else {
        // Return object
        return $d;
    }
}

function crearCodigoUnico($inicio, $id, $longitud = 6)
{
    $length = strlen($id . "");
    $codigo = "";
    for ($i = 0; $i < $longitud - $length; $i++) {
        $codigo = "0" . $codigo;
    }
    $codigo .= $id;
    $codigo = $inicio . "-" . $codigo;
    return $codigo;
}

function crearCodigoUnicoConsecutivo($inicio, $lastCodigo, $longitud = 6)
{
    $lastSolCod = explode('-', $lastCodigo)[1];
    $numeroEntero = intval($lastSolCod);
    $length = strlen($numeroEntero . "");
    $codigo = "";
    for ($i = 0; $i < $longitud - $length; $i++) {
        $codigo = "0" . $codigo;
    }
    $codigo .= ($numeroEntero + 1);
    $codigo = $inicio . "-" . $codigo;
    return $codigo;
}
