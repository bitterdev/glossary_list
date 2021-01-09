<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Block\Autonav\Controller;
use Concrete\Core\View\View;

/** @var Controller $controller */
$navItems = $controller->getNavItems(true);

$items = [];

if (count($navItems) > 0) {
    foreach ($navItems as $ni) {
        $items[$ni->url] = $ni->name;
    }
}

/** @noinspection PhpUnhandledExceptionInspection */
View::element("/glossary_list", ["items" => $items], "glossary_list");