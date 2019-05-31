<?php
namespace SymfonyDomCrawlerTester\Exception;

use Calgamo\Exception\CalgamoException;
use Calgamo\Exception\Runtime\RuntimeExceptionInterface;

class SystemFaultException extends CalgamoException implements RuntimeExceptionInterface
{
    /**
     * SystemFaultException constructor.
     *
     * @param string symbol
     * @param \Throwable|NULL $prev
     */
    public function __construct( string $message, \Throwable $prev = NULL )
    {
        parent::__construct( $message, $prev );
    }
}