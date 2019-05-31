<?php
ini_set('memory_limit', -1);
set_time_limit(0);

require_once dirname(__DIR__). '/vendor/autoload.php';

spl_autoload_register(function ($class)
{
    if (strpos($class, 'SymfonyDomCrawlerTester\\') === 0) {
        $name = substr($class, strlen('SymfonyDomCrawlerTester\\'));
        $name = array_filter(explode('\\',$name));
        $file = dirname(__DIR__) . '/src/' . implode('/',$name) . '.php';
        /** @noinspection PhpIncludeInspection */
        require_once $file;
    }
});
