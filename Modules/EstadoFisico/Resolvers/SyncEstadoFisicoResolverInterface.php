<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:53
 */

namespace Modules\EstadoFisico\Resolvers;


use Modules\Sincronizacion\Entities\Syncronizacion;

interface SyncEstadoFisicoResolverInterface
{
    public function handle(Syncronizacion $syncronizacion);
}
