<?php

namespace Bitter\GlossaryList\Provider;

use Concrete\Core\Application\Application;
use Concrete\Core\Asset\AssetList;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Routing\RouterInterface;
use Bitter\GlossaryList\Routing\RouteList;

class ServiceProvider extends Provider
{
    protected RouterInterface $router;

    public function __construct(
        Application     $app,
        RouterInterface $router
    )
    {
        parent::__construct($app);

        $this->router = $router;
    }

    public function register()
    {
        $this->registerRoutes();
        $this->registerAssets();
    }

    private function registerAssets()
    {
        $al = AssetList::getInstance();
        $al->register("javascript", "glossary-list", "js/glossary-list.js", [], "glossary_list");
        $al->register("css", "glossary-list", "css/glossary-list.css", [], "glossary_list");
        $al->registerGroup("glossary-list", [
            ["javascript", "glossary-list"],
            ["css", "glossary-list"]
        ]);
    }

    private function registerRoutes()
    {
        $this->router->loadRouteList(new RouteList());
    }
}