<?php

namespace App\Router;

use App\Route\Routes;
use Zend\Expressive\Router\FastRouteRouter;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\Route;

class Router
{
    /**
     * Router implementation bridging nikic/fast-route.
     *
     * @var FastRouteRouter
     */
    private $router;

    public function __construct()
    {
        $this->router = new FastRouteRouter();
    }

    /**
     * Add a route to the collection.
     *
     * @param string $path
     * @param callable $callable
     * @param string $name
     * @return void
     */
    public function get(string $path, callable $callable, string $name)
    {
        $this->getRouter()->addRoute(new Route($path, $callable, ["GET"], $name));
    }

    /**
     * Match a request against the known routes.
     *
     * @param ServerRequestInterface $request
     * @return Routes|null
     */
    public function matching(ServerRequestInterface $request): ?Routes
    {
        $result = $this->getRouter()->match($request);
        if ($result->isSuccess()) {
            return new Routes(
                $result->getMatchedRouteName(),
                $result->getMatchedMiddleware(),
                $result->getMatchedParams()
            );
        }
        return null;
    }

    /**
     * Match a request against the known routes.
     *
     * @param string $name
     * @param array $params
     * @return string|null
     */
    public function generateUri(string $name, array $params): ?string
    {
        return $this->getRouter()->generateUri($name, $params);
    }

    /**
     * Get router implementation bridging nikic/fast-route.
     *
     * @return  FastRouteRouter
     */ 
    public function getRouter()
    {
        return $this->router;
    }
}
