<?php
namespace SymfonyDomCrawlerTester\ApplicationFactory;

use Calgamo\Kernel\ApplicationFactoryInterface;
use Calgamo\Kernel\ApplicationInterface;
use Calgamo\Kernel\FileSystemInterface;
use Calgamo\Kernel\NullObject\NullApplication;
use SymfonyDomCrawlerTester\App\Api\ApiApplication;

class MyAppApplicationFactory implements ApplicationFactoryInterface
{
    /**
     * Create appication by type
     *
     * @param string $app_type
     * @param FileSystemInterface $filesystem
     *
     * @return ApplicationInterface
     */
    public function createApplication(string $app_type, FileSystemInterface $filesystem) : ApplicationInterface
    {
        switch($app_type)
        {
            case 'api':
                return new ApiApplication($filesystem);
                break;

        }

        return new NullApplication();
    }
}