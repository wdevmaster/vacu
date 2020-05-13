<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 12/05/20
 * Time: 23:03
 */

namespace Modules\CondicionCorporal\Resolvers;


use Modules\Sincronizacion\Entities\Syncronizacion;

interface SynCondicionCorporalResolverInterface
{
    public function handle(Syncronizacion $syncronizacion);
}
