<?php

namespace App\Controllers;

use App\Renderer\Renderer;
use App\Router\Router;

class IndexController
{
    private $router;

    private $renderer;

    public function __construct(Router $router,Renderer $renderer)
    {
        $this->router = $router;
        $this->renderer = $renderer;
        $this->renderer->addPath("index", dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."index");
        $this->router->get("/index", [$this, "show"], "home.page");
    }

    public function show()
    {
        $doc = $this->getRenderer()->create("index");
        $markup = "Index content";
        $doc["main"]->append($markup);
        print $doc;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }
}