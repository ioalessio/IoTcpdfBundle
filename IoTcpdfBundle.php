<?php

namespace Io\TcpdfBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;

define('K_TCPDF_EXTERNAL_CONFIG', true);

class IoTcpdfBundle extends Bundle
{
	public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Force extension load
        $container->registerExtension(new \Io\TcpdfBundle\DependencyInjection\IoTcpdfExtension());
    }
}
