<?php

namespace Bitter\GlossaryList\Routing;

use Bitter\GlossaryList\API\V1\Middleware\FractalNegotiatorMiddleware;
use Bitter\GlossaryList\API\V1\Configurator;
use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router
            ->buildGroup()
            ->setNamespace('Concrete\Package\GlossaryList\Controller\Dialog\Support')
            ->setPrefix('/ccm/system/dialogs/glossary_list')
            ->routes('dialogs/support.php', 'glossary_list');
    }
}