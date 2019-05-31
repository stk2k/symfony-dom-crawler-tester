<?php
namespace SymfonyDomCrawlerTester\App\Api;

use Calgamo\Kernel\ApplicationInterface;
use Calgamo\Framework\Application\CalgamoApplication;
use Calgamo\Framework\Package\CalgamoFrameworkPackage;
use Calgamo\Framework\Package\GuzzleHttpPackage;
use Calgamo\Framework\Module\Session\AuraSessionModule;
use SymfonyDomCrawlerTester\App\Api\Module\ApiRouterModule;
use SymfonyDomCrawlerTester\App\Api\Module\ApiDiModule;

class ApiApplication extends CalgamoApplication
{
    /**
     * Configure application
     *
     * @throws
     */
    public function configure() : ApplicationInterface
    {
        $this->requirePackage(CalgamoFrameworkPackage::class);
        $this->requirePackage(GuzzleHttpPackage::class);
        $this->requireModule(ApiRouterModule::class);
        $this->requireModule(ApiDiModule::class);
        $this->requireModule(AuraSessionModule::class);
        return $this;
    }
}