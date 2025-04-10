<?php

defined('C5_EXECUTE') or die('Access denied');

$app = Concrete\Core\Support\Facade\Application::getFacadeApplication();

$th = $app->make('helper/text');

$items = array();

if (count($pages) > 0) {
    foreach ($pages as $page) {
        $items[$nh->getLinkToCollection($page)] = $th->entities($page->getCollectionName());
    }
}

View::element("/glossary_list", ["items" => $items], "glossary_list");