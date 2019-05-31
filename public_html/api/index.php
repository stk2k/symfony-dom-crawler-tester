<?php
$base_dir = dirname(dirname(__DIR__));

require_once $base_dir . '/include/init.php';

use Calgamo\Kernel\Bootstrap\Bootstrap;
use Calgamo\Kernel\Constants\ErrorDisplayModes;
use SymfonyDomCrawlerTester\ApplicationFactory\MyAppApplicationFactory;
use SymfonyDomCrawlerTester\App\Api\FileSystem\ApiFileSystem;

$bootstrap = (new Bootstrap())->mount(new ApiFileSystem($base_dir));
$app = $bootstrap->newApp('api', new MyAppApplicationFactory());
try {
    $app->run();
} catch (Throwable $e) {
    if (!$app->handleException($e)) {
        $bootstrap->handleException($e, ErrorDisplayModes::HTML);
    }
}
