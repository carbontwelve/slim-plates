<?php namespace Carbontwelve\SlimPlates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Slim\Interfaces\RouterInterface;

class PlatesSlimRouterExtension implements ExtensionInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function register(Engine $engine)
    {
        $engine->registerFunction('pathFor', [$this->router, 'pathFor']);
    }
}
