<?php
namespace SymfonyDomCrawlerTester\App\Api\Module;

use Throwable;

use Calgamo\Kernel\ApplicationInterface;
use Calgamo\Kernel\ModuleInterface;
use Calgamo\Kernel\Module\AbstractModule;
use Calgamo\Kernel\Constants\Components;
use Calgamo\Kernel\Exception\ModuleInstallationException;
use Calgamo\Router\Router;
use Calgamo\Router\Builder\PhpArrayRouterBuilder;
use Calgamo\Framework\Adapter\CalgamoRouterAdapter;
use Calgamo\Http\Middleware\WebServerRoutingMiddleware;

class ApiRouterModule extends AbstractModule implements ModuleInterface
{
    private $routing_rule = [
        '/api/crawler/filter' => 'crawler.filter'
    ];

    /**
     * Declare dependent on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [
            ApiDiModule::class,
        ];
    }

    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponents() : array
    {
        return [
            Components::DI,
            Components::PIPELINE,
            Components::LOGGER,
        ];
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws ModuleInstallationException
     */
    public function install(ApplicationInterface $app)
    {
        try{
            $c = $app->di();

            $router = new Router($c['dispatcher']);
            (new PhpArrayRouterBuilder($router, $this->routing_rule))->build();

            $app->router(new CalgamoRouterAdapter($router));

            $app->pipeline()->push(new WebServerRoutingMiddleware($app));
        }
        catch(Throwable $e)
        {
            throw new ModuleInstallationException('', $e);
        }
    }
}