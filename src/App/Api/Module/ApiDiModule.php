<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace SymfonyDomCrawlerTester\App\Api\Module;

use Calgamo\Di\Container;
use Calgamo\Kernel\ApplicationInterface;
use Calgamo\Kernel\Constants\Components;
use Calgamo\Kernel\ModuleInterface;
use Calgamo\Kernel\Module\AbstractModule;
use Calgamo\Kernel\Exception\ModuleInstallationException;

use SymfonyDomCrawlerTester\App\Api\Dispatcher\ApiDispatcher;

class ApiDiModule extends AbstractModule implements ModuleInterface
{
    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponents() : array
    {
        return [
            Components::SESSION,
            Components::ENV,
        ];
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws  ModuleInstallationException
     */
    public function install(ApplicationInterface $app)
    {
        try{
            $c = $app->di();
            
            //$fs = $app->fileSystem();
            //$session = $app->session();
            $logger = $app->logger();

            //====================================
            // Components
            //====================================

            // dispatcher factory
            $c['dispatcher'] = function(Container $c) use($logger){
                $component = new ApiDispatcher($logger,$c);
                return $component;
            };

            //====================================
            // Arrays
            //====================================

            // arrays.app_config immediate value
            $c['arrays.app_config'] = function(){
                return [
                    'constants' => [
                    ],
                    'is_debug' =>false
                ];
            };

            //====================================
            // Strings
            //====================================

            //====================================
            // Services
            //====================================

        }
        catch(\Throwable $e)
        {
            throw new ModuleInstallationException('Failed to install di module', $e);
        }
    }
}