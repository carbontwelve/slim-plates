<?php namespace Carbontwelve\SlimPlates;

use Carbontwelve\SlimPlates\Exceptions\InvalidSettingsException;
use Interop\Container\ContainerInterface;
use League\Plates\Engine;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class PimplePlatesViewProvider implements ServiceProviderInterface
{
    /**
     * @param ContainerInterface|Container $pimple A container instance
     * @return Engine
     * @throws InvalidSettingsException
     */
    public function register(Container $pimple)
    {
        $settings = $pimple->get('settings')['renderer'];
        if (is_null($settings)){
            throw new InvalidSettingsException('Please configure the renderer settings with valid `template_path` and `template_ext` values.');
        }
        $pimple['renderer'] = new PlatesRenderer($settings['template_path'], $settings['template_ext']);
    }
}
