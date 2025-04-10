<?php

defined('C5_EXECUTE') or die('Access denied');

$navItems = $controller->getNavItems(true);

$items = array();

if (count($navItems) > 0) {
    foreach ($navItems as $ni) {
        $items[$ni->url] = $ni->name;
    }
}

View::element("/glossary_list", ["items" => $items], "glossary_list");