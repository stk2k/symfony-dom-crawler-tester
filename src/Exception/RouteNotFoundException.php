<?php
namespace SymfonyDomCrawlerTester\Exception;

use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

class RouteNotFoundException extends CalgamoException implements RuntimeExceptionInterface
{
    /**
     * RouteNotFoundException constructor.
     *
     * @param string $message
     * @param \Throwable|NULL $prev
     */
    public function __construct( string $message, \Throwable $prev = NULL )
    {
        parent::__construct( "Route not found: $message", $prev );
    }
}