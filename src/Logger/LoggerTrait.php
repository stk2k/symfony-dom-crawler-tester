<?php
namespace SymfonyDomCrawlerTester\Logger;

use Calgamo\Util\Util;
use Calgamo\Kernel\LoggerInterface;

trait LoggerTrait
{
    /**
     * Get logger
     *
     * @return LoggerInterface
     */
    public abstract function getLogger() : LoggerInterface;

    /**
     * write trace log
     *
     * @param string $message
     */
    public function trace(string $message)
    {
        list($file, $line) = Util::caller(1);
        $context = [
            'file' => $file,
            'line' => $line,
        ];
        $this->getLogger()->info($message, $context);
    }

    /**
     * write info log
     *
     * @param string $message
     */
    public function info(string $message)
    {
        list($file, $line) = Util::caller(1);
        $context = [
            'file' => $file,
            'line' => $line,
        ];
        $this->getLogger()->info($message, $context);
    }

    /**
     * write debug log
     *
     * @param string $message
     */
    public function debug(string $message)
    {
        list($file, $line) = Util::caller(1);
        $context = [
            'file' => $file,
            'line' => $line,
        ];
        $this->getLogger()->debug($message, $context);
    }

    /**
     * write warning log
     *
     * @param string $message
     */
    public function warning(string $message)
    {
        list($file, $line) = Util::caller(1);
        $context = [
            'file' => $file,
            'line' => $line,
        ];
        $this->getLogger()->warning($message, $context);
    }

    /**
     * write error log
     *
     * @param string $message
     */
    public function error(string $message)
    {
        list($file, $line) = Util::caller(1);
        $context = [
            'file' => $file,
            'line' => $line,
        ];
        $this->getLogger()->error($message, $context);
    }

    /**
     * write fatal log
     *
     * @param string $message
     */
    public function fatal(string $message)
    {
        list($file, $line) = Util::caller(1);
        $context = [
            'file' => $file,
            'line' => $line,
        ];
        $this->getLogger()->error($message, $context);
    }

}