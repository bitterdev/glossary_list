<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\Form\Service\Form;
use Concrete\Core\Form\Service\Widget\Color;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\View\View;

/** @noinspection PhpUnhandledExceptionInspection */
View::element('/dashboard/Help', null, 'glossary_list');
/** @noinspection PhpUnhandledExceptionInspection */
View::element('/dashboard/Reminder', ["packageHandle" => "glossary_list", "rateUrl" => "https://www.concrete5.org/marketplace/addons/glossary-list/reviews"], 'glossary_list');

/** @var int $rootPageId */
/** @var string $itemColor */
/** @var string $headlineColor */
/** @var string $navItemColor */
/** @var string $navItemColorHover */

$colorHelperDefaults = [
    'className' => 'ccm-widget-colorpicker',
    'showInitial' => true,
    'showInput' => true,
    'cancelText' => t('Cancel'),
    'chooseText' => t('Choose'),
    'showAlpha' => true,
    'clearText' => t('Clear Color Selection')
];

$app = Application::getFacadeApplication();
/** @var Form $form */
$form = $app->make(Form::class);
/** @var Color $colorHelper */
$colorHelper = $app->make(Color::class);

?>
<?php /** @noinspection PhpUnhandledExceptionInspection */
View::element('/dashboard/license_check', array("packageHandle" => "glossary_list"), 'glossary_list'); ?>

<div class="form-group">
    <?php echo $form->label("rootPageId", t("Root Page")); ?>
    <?php echo $app->make('helper/form/page_selector')->selectPage("rootPageId", $rootPageId); ?>
</div>

<hr>

<div class="form-group">
    <?php echo $form->label("itemColor", t("Item Color")); ?>
    <?php $colorHelper->output("itemColor", $itemColor, $colorHelperDefaults); ?>
</div>

<div class="form-group">
    <?php echo $form->label("headlineColor", t("Headline Color")); ?>
    <?php $colorHelper->output("headlineColor", $headlineColor, $colorHelperDefaults); ?>
</div>

<div class="form-group">
    <?php echo $form->label("navItemColor", t("Navigation Item Color")); ?>
    <?php $colorHelper->output("navItemColor", $navItemColor, $colorHelperDefaults); ?>
</div>

<div class="form-group">
    <?php echo $form->label("navItemColorHover", t("Navigation Item Color (Hover)")); ?>
    <?php $colorHelper->output("navItemColorHover", $navItemColorHover, $colorHelperDefaults); ?>
</div>

<!--suppress CssUnusedSymbol -->
<style type="text/css">
    .form-group {
        clear: both;
    }

    .ccm-widget-colorpicker {
        float: right;
    }

    .ui-dialog {
        overflow: visible !important;
    }
</style>

<?php
/** @noinspection PhpUnhandledExceptionInspection */
View::element('/dashboard/did_you_know', array("packageHandle" => "glossary_list"), 'glossary_list'); ?>
