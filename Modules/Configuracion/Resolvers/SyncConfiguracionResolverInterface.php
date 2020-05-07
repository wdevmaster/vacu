<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 12:33
 */

namespace Modules\Configuracion\Resolvers;


use Modules\Sincronizacion\Entities\Syncronizacion;

interface SyncConfiguracionResolverInterface
{
    public function handle(Syncronizacion $sincronizacion);
}
