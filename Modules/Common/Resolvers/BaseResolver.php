<?php
/**
 * Created by IntelliJ IDEA.
 * User: nerox
 * Date: 12/05/20
 * Time: 22:18
 */

namespace Modules\Common\Resolvers;


use Modules\Sincronizacion\Repositories\TraductorRepository;

class BaseResolver
{
    /**
     * @var TraductorRepository
     */
    protected $traductorRepository;

    protected $generateCodeResolver;

    public function __construct(TraductorRepository $traductorRepository, GenerateCodeResolverInterface $generateCodeResolver)
    {
        $this->traductorRepository = $traductorRepository;
        $this->generateCodeResolver = $generateCodeResolver;
    }
}
