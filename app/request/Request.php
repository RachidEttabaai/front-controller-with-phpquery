<?php

namespace App\Request;

use App\Router\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Request
{

    public function __construct()
    {

    }
 
    private function redirectUri(int $statusCode, string $uri): Response
    {
        return (new Response())->withStatus($statusCode)->withHeader("Location", $uri);
    }

    private function checkRequestResponse($response): ResponseInterface
    {
        if (is_string($response)) {
            return new Response(200, [], $response);
        } elseif ($response instanceof ResponseInterface) {
            return $response;
        } else {
            throw new \Exception("Houston we have got a problem!!!");
        }
    }

    private function checkUri(string $uri): ResponseInterface
    {
        if (!empty($uri) && $uri[-1] === "/") {
            //echo rtrim($uri, "/");
            return $this->redirectUri(301, rtrim($uri, "/"));
        }

        return $this->redirectUri(301, "/index");
    }

    public function requestmanage(ServerRequestInterface $request,Router $router): ResponseInterface
    {
        $uri = $request->getUri()->getPath();

        $this->checkUri($uri);

        $route = $router->matching($request);

        if (is_null($route)) {
            return $this->redirectUri(301, "/index");
        } else {

            $response = call_user_func_array($route->getCallable(), [$request]);
            
            if(!is_null($response)){
                return $this->checkRequestResponse($response);
            }else{
                return $this->checkRequestResponse("");
            }

        }

    }

}