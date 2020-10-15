<?php

namespace App\Controllers;

use App\Entity\Language;
use App\Renderer\Renderer;
use App\Router\Router;

class ListingController
{
    private $router;

    private $renderer;

    public function __construct(Router $router,Renderer $renderer)
    {
        $this->router = $router;
        $this->renderer = $renderer;
        $this->renderer->addPath("listing", dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."listing");
        $this->router->get("/listing", [$this, "show"], "listing.page");
    }

    public function show()
    {
        $doc = $this->getRenderer()->create("listing");
        $languages = (new Language())->findAll();
        $ul = "<ul>";
        foreach ($languages as $language) {
            $ul .= "<li>".$language["language_name"]." ".$language["language_part"]."</li>";
        }
        $content = $ul . "</ul>";
        $doc["main"]->append($content);
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