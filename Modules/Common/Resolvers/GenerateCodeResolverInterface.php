<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 7/05/20
 * Time: 13:15
 */

namespace Modules\Common\Resolvers;


interface GenerateCodeResolverInterface
{
    public function handle($user_code, $tabla,$negocio_id);
}
