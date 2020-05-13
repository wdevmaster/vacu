<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 11/05/20
 * Time: 23:53
 */

namespace Modules\Enfermedad\Resolvers;


use Modules\Sincronizacion\Entities\Syncronizacion;

interface SyncEnfermedadesResolverInterface
{
    public function handle(Syncronizacion $syncronizacion);
}
