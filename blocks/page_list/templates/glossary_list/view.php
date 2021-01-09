<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\Html\Service\Navigation;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Utility\Service\Text;
use Concrete\Core\View\View;

$app = Application::getFacadeApplication();

/** @var Page[] $pages */
/** @var Text $textHelper */
$textHelper = $app->make(Text::class);
/** @var Navigation $nh */
$nh = $app->make(Navigation::class);

$items = [];

if (count($pages) > 0) {
    foreach ($pages as $page) {
        /** @noinspection PhpParamsInspection */
        $items[$nh->getLinkToCollection($page)] = $textHelper->entities($page->getCollectionName());
    }
}

/** @noinspection PhpUnhandledExceptionInspection */
View::element("/glossary_list", ["items" => $items], "glossary_list");