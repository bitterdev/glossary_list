<?php

/**
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Block\BlockType\BlockType;
use Concrete\Core\Package\Package;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\View\View;

/** @var string $packageHandle */
/** @var string $blockHandle */
/** @var array $blockParams */

$app = Application::getFacadeApplication();
/** @var PackageService $packageService */
$packageService = $app->make(PackageService::class);
$package = $packageService->getByHandle($packageHandle);
/** @var Package $packageController */
$packageController = $package->getController();

$glossaryCss = $packageController->getRelativePath() . "/blocks/" . $blockHandle . "/view.css";
$glossaryJs = $packageController->getRelativePath() . "/blocks/" . $blockHandle . "/view.js";

$view = View::getInstance();

$view->addHeaderItem("<link rel=\"stylesheet\" href=\"" . $glossaryCss . "\" />");
$view->addFooterItem("<script src=\"" . $glossaryJs . "\"></script>");

/** @var BlockType $blockType */
$blockType = BlockType::getByHandle($blockHandle);

if (is_array($blockParams)) {
    foreach ($blockParams as $value => $key) {
        /** @noinspection PhpUndefinedFieldInspection */
        $blockType->controller->set($value, $key);
    }
}

/** @noinspection PhpUndefinedMethodInspection */
$blockType->render();