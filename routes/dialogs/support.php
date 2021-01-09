<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Routing\Router;

/**
 * @var Router $router
 * Base path: /ccm/system/dialogs/glossary_list
 * Namespace: Concrete\Package\GlossaryList\Controller\Dialog
 */

$router->all('/create_ticket', 'CreateTicket::view');
$router->all('/create_ticket/submit', 'CreateTicket::submit');