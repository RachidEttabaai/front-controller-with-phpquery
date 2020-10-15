<?php

namespace App\Core;

use App\Router\Router;
use App\Request\Request;
use App\Renderer\Renderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Init
{
    private $controllerslist;

    private $router;

    private $renderer;

    public function __construct(array $controllerslist)
    {
        $this->router = new Router();
        $this->renderer = new Renderer();

        if (!empty($controllerslist)) {
            foreach ($controllerslist as $controller) {
                $this->controllerslist[] = new $controller($this->router,$this->renderer);
            }
        }

    }

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        return (new Request())->requestmanage($request,$this->router);
    }
}
