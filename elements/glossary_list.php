<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\View\View;

asort($items);

$groupedItems = [];

foreach ($items as $itemUrl => $itemName) {
    $firstLetter = strtoupper(mb_substr($itemName, 0, 1, 'utf-8'));

    $groupedItems[$firstLetter][$itemUrl] = $itemName;
}

$viewOptions = [];

$viewOptions["packageHandle"] = "glossary_list";
$viewOptions["blockHandle"] = "glossary_list";
$viewOptions["blockParams"]["groupedItems"] = $groupedItems;
$viewOptions["blockParams"]["itemColor"] = "inherit";
$viewOptions["blockParams"]["navItemColorHover"] = "inherit";
$viewOptions["blockParams"]["navItemColor"] = "inherit";
$viewOptions["blockParams"]["headlineColor"] = "inherit";

/** @noinspection PhpUnhandledExceptionInspection */
View::element('/generic_block', $viewOptions, 'glossary_list');
