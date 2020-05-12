<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:53
 */

namespace Modules\Animal\Resolvers;


use Modules\Sincronizacion\Entities\Syncronizacion;

interface SyncAnimalesResolverInterface
{
    public function handle(Syncronizacion $syncronizacion);
}
