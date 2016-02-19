<?php

namespace Carbontwelve\SlimPlates;

use Carbontwelve\SlimPlates\Exceptions\InvalidSettingsException;
use Interop\Container\ContainerInterface;
use League\Plates\Engine;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PlatesViewProvider implements ServiceProviderInterface
{
    /**
     * @param ContainerInterface|Container $pimple A container instance
     *
     * @throws InvalidSettingsException
     *
     * @return Engine
     */
    public function register(Container $pimple)
    {
        $settings = $pimple->get('settings')['renderer'];
        if (is_null($settings)) {
            throw new InvalidSettingsException('Please configure the renderer settings with valid `template_path` and `template_ext` values.');
        }

        $engine = new PlatesRenderer($settings['template_path'], $settings['template_ext']);
        $engine->getEngine()->loadExtension(
            new PlatesSlimRouterExtension($pimple->get('router'))
        );

        $pimple['renderer'] = $engine;
    }
}
