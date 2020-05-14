<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:53
 */

namespace Modules\Negocio\Resolvers;


use Modules\Sincronizacion\Entities\Syncronizacion;

interface SyncNegocioResolverInterface
{
    public function handle(Syncronizacion $syncronizacion);
}
