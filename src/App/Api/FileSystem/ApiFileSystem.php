<?php
namespace SymfonyDomCrawlerTester\App\Api\FileSystem;

use Calgamo\Kernel\FileSystemInterface;
use Calgamo\Kernel\FileSystem\AbstractFileSystem;

class ApiFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    /** @var string */
    private $base_dir;
    
    /**
     * FrontFileSystem constructor.
     *
     * @param string $base_dir
     */
    public function __construct(string $base_dir)
    {
        $this->base_dir = $base_dir;
    }
    
    /**
     * Get directory path
     *
     * @param string $key
     *
     * @return string
     */
    public function getDirectory(string $key) : string
    {
        switch($key)
        {
            case 'tmp':
                return $this->base_dir . '/tmp';
    
            case 'cache':
                return $this->base_dir . '/cache';
    
            case 'logs':
                return $this->base_dir . '/logs/api';

            case 'env':
                return $this->base_dir . '/env';

            case 'config':
                return $this->base_dir . '/config/api';
        }
        return null;
    }
}