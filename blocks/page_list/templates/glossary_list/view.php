<?php

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\Html\Service\Navigation;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Utility\Service\Text;
use Concrete\Core\View\View;

/** @var Page[] $pages */
$app = Application::getFacadeApplication();
/** @var Text $th */
/** @noinspection PhpUnhandledExceptionInspection */
$th = $app->make(Text::class);
/** @var Navigation $nh */
/** @noinspection PhpUnhandledExceptionInspection */
$nh = $app->make(Navigation::class);

$items = [];

if (count($pages) > 0) {
    foreach ($pages as $page) {
        $items[$nh->getLinkToCollection($page)] = $th->entities($page->getCollectionName());
    }
}

/** @noinspection PhpUnhandledExceptionInspection */
View::element("glossary_list", ["items" => $items], "glossary_list");