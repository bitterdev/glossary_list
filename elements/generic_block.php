<?php

defined('C5_EXECUTE') or die("Access Denied.");

$glossaryCss = Package::getByHandle($packageHandle)->getRelativePath() . "/blocks/" . $blockHandle . "/view.css";
$glossaryJs = Package::getByHandle($packageHandle)->getRelativePath() . "/blocks/" . $blockHandle . "/view.js";

\View::getInstance()->addHeaderItem("<link rel=\"stylesheet\" href=\"" . $glossaryCss . "\" />");
\View::getInstance()->addFooterItem("<script src=\"" . $glossaryJs . "\"></script>");

$blockType = BlockType::getByHandle($blockHandle);

if (is_array($blockParams)) {
    foreach($blockParams as $value => $key) {
        $blockType->controller->set($value, $key);
    }
}

$blockType->render();