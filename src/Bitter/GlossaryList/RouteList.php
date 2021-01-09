<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace Bitter\GlossaryList;

use Concrete\Core\Routing\RouteListInterface;
use Concrete\Core\Routing\Router;

class RouteList implements RouteListInterface
{
    public function loadRoutes(Router $router)
    {
        $router
            ->buildGroup()
            ->routes('api.php', 'glossary_list');

        $router
            ->buildGroup()
            ->setNamespace('Concrete\Package\GlossaryList\Controller\Dialog\Support')
            ->setPrefix('/ccm/system/dialogs/glossary_list')
            ->routes('dialogs/support.php', 'glossary_list');
    }
}