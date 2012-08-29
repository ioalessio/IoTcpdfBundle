<?php

namespace Io\TcpdfBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class IoTcpdfExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // this line is the key
        $this->bindParameter($container, 'io_tcpdf', $config);

//        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        //defineTCPDF Cache
        define('K_PATH_URL', '');
        define('K_PATH_MAIN', $container->getParameter('kernel.root_dir').'/../vendor/tcpdf/tcpdf/');
        define('K_PATH_CACHE', $container->getParameter('kernel.cache_dir'));
        define('K_PATH_FONTS', K_PATH_MAIN.'fonts/');
        define('K_PATH_URL_CACHE', K_PATH_URL.'cache/');
        define('K_PATH_IMAGES', $container->getParameter('kernel.root_dir').'/../web/');
        define('K_BLANK_IMAGE', K_PATH_IMAGES.'_blank.png');
        define('PDF_PAGE_FORMAT', 'A4');
        define('PDF_PAGE_ORIENTATION', 'P');
        define('PDF_HEADER_LOGO_WIDTH', 30);
        define('PDF_UNIT', 'mm');
        define('PDF_MARGIN_HEADER', 5);
        define('PDF_MARGIN_FOOTER', 10);
        define('PDF_MARGIN_TOP', 27);
        define('PDF_MARGIN_BOTTOM', 25);
        define('PDF_MARGIN_LEFT', 15);
        define('PDF_CREATOR', 'TCPDF');
        define('PDF_AUTHOR', 'TCPDF');
        define('PDF_HEADER_TITLE', '');
        define('PDF_HEADER_STRING', '');
        define('PDF_HEADER_LOGO',  '');
        define('PDF_MARGIN_RIGHT', 15);
        define('PDF_FONT_NAME_MAIN', 'helvetica');
        define('PDF_FONT_SIZE_MAIN', 10);
        define('PDF_FONT_NAME_DATA', 'helvetica');
        define('PDF_FONT_SIZE_DATA', 8);
        define('PDF_FONT_MONOSPACED', 'courier');
        define('PDF_IMAGE_SCALE_RATIO', 1.25);
        define('HEAD_MAGNIFICATION', 1.1);
        define('K_CELL_HEIGHT_RATIO', 1.25);
        define('K_TITLE_MAGNIFICATION', 1.3);
        define('K_SMALL_RATIO', 2/3);
        define('K_THAI_TOPCHARS', true);
        define('K_TCPDF_CALLS_IN_HTML', true);
    }

     /**
     * Set the given parameters to the given container
     * @param ContainerBuilder $container
     * @param string           $name
     * @param mixed            $value
     */
    private function bindParameter(ContainerBuilder $container, $name, $value)
    {
        if ( is_array($value) ) {

            foreach ($value as $index => $val) {
                $this->bindParameter($container, $name.'.'.$index, $val);
            }
            $container->setParameter($name, $value);
        } else {
            $container->setParameter($name, $value);
        }
    }

}
