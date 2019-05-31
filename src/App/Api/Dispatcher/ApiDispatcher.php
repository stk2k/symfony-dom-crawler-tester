<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace SymfonyDomCrawlerTester\App\Api\Dispatcher;

use Calgamo\Framework\Util\LoggerUtil;
use Calgamo\Di\ContainerInterface;
use Calgamo\Router\DispatcherInterface;
use Calgamo\Router\Router;
use Calgamo\Kernel\LoggerInterface;

use SymfonyDomCrawlerTester\App\Api\Responder\CrawlerApiResponder;
use SymfonyDomCrawlerTester\Exception\RouteNotFoundException;
use SymfonyDomCrawlerTester\Logger\LoggerTrait;
use SymfonyDomCrawlerTester\App\Api\Responder\ApiResponder;

class ApiDispatcher implements DispatcherInterface
{
    use LoggerTrait;

    /** @var LoggerInterface */
    private $logger;

    /** @var ContainerInterface */
    private $container;

    public function __construct(LoggerInterface $logger, ContainerInterface $container)
    {
        $this->logger = $logger;
        $this->container = $container;
    }

    /**
     * Get logger
     *
     * @return LoggerInterface
     */
    public function getLogger() : LoggerInterface
    {
        return $this->logger;
    }

    /**
     * Dispatch event
     *
     * @param array $vars
     * @param string $route_name
     *
     * @return bool
     *
     * @throws
     */
    public function dispatch(array $vars, string $route_name)
    {
        try{
            switch($route_name){
                case Router::ROUTE_NOT_FOUND:
                    (new ApiResponder($this->logger))->errorResponse(-1, "ROUTE_NOT_FOUND");
                    break;

                case 'crawler.filter':
                    $html = filter_input(INPUT_POST, 'html');
                    $selector = filter_input(INPUT_POST, 'selector');
                    (new CrawlerApiResponder($this->logger))->filter($html ?? '', $selector ?? '');
                    break;

                default:
                    throw new RouteNotFoundException($route_name);
            }
        }
        catch( \Throwable $e )
        {
            LoggerUtil::logException($e, $this->logger);

            (new ApiResponder($this->logger))->errorResponse(-1, $e->getMessage());
        }
        return true;
    }
}