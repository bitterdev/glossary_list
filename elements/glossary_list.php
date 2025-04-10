<?php

defined('C5_EXECUTE') or die("Access Denied.");

asort($items);

$groupedItems = array();

foreach($items as $itemUrl => $itemName) {
    $firstLetter = strtoupper(mb_substr($itemName, 0, 1, 'utf-8'));

    $groupedItems[$firstLetter][$itemUrl] = $itemName;
}

$viewOptions = array();

$viewOptions["packageHandle"] = "glossary_list";
$viewOptions["blockHandle"] = "glossary_list";
$viewOptions["blockParams"]["groupedItems"] = $groupedItems;
$viewOptions["blockParams"]["itemColor"] = "inherit";
$viewOptions["blockParams"]["navItemColorHover"] = "inherit";
$viewOptions["blockParams"]["navItemColor"] = "inherit";
$viewOptions["blockParams"]["headlineColor"] = "inherit";

View::element('/generic_block', $viewOptions, 'glossary_list');
