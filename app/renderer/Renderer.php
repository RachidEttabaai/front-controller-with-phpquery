<?php

namespace App\Renderer;

use phpQuery;

class Renderer
{
    const NAMESPACE_BYDEFAULT = "__MAIN";

    private $paths = [];

    private $globals = [];

    public function __construct(?string $defaultPath = null)
    {
        if (!is_null($defaultPath)) {
            $this->addPath($defaultPath);
        }

    }

    public function addPath(string $namespace, ?string $path = null): void
    {
        if (is_null($path)) {
            $this->paths[self::NAMESPACE_BYDEFAULT] = $namespace;
        } else {
            $this->paths[$namespace] = $path;
        }
    }

    public function addGlobal(string $key, $value): void
    {
        $this->globals[$key] = $value;
    }

    public function create(string $view)
    {
        require_once(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."/somesh/php-query/phpQuery/phpQuery.php");
        return phpQuery::newDocumentFile($this->getPaths()[$view].".html");
    }

    /**
     * Get the value of paths
     */ 
    public function getPaths()
    {
        return $this->paths;
    }
}