<?php

defined('C5_EXECUTE') or die('Access denied');


$colorHelperDefaults = array(
    'className' => 'ccm-widget-colorpicker',
    'showInitial' => true,
    'showInput' => true,
    'cancelText' => t('Cancel'),
    'chooseText' => t('Choose'),
    'showAlpha' => true,
    'clearText' => t('Clear Color Selection')
);

$colorHelper = $app->make('helper/form/color');

View::element("dashboard/help_blocktypes", [], "glossary_list");
?>

<div class="form-group">
    <?php echo $form->label("rootPageId", t("Root Page")); ?>
    <?php echo $app->make('helper/form/page_selector')->selectPage("rootPageId", $rootPageId); ?>
</div>

<hr>

<div class="form-group">
    <?php echo $form->label("itemColor", t("Item Color")); ?>
    <?php echo $colorHelper->output("itemColor", $itemColor, $colorHelperDefaults); ?>
</div>

<div class="form-group">
    <?php echo $form->label("headlineColor", t("Headline Color")); ?>
    <?php echo $colorHelper->output("headlineColor", $headlineColor, $colorHelperDefaults); ?>
</div>

<div class="form-group">
    <?php echo $form->label("navItemColor", t("Navigation Item Color")); ?>
    <?php echo $colorHelper->output("navItemColor", $navItemColor, $colorHelperDefaults); ?>
</div>

<div class="form-group">
    <?php echo $form->label("navItemColorHover", t("Navigation Item Color (Hover)")); ?>
    <?php echo $colorHelper->output("navItemColorHover", $navItemColorHover, $colorHelperDefaults); ?>
</div>

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
<?php \Concrete\Core\View\View::element('/dashboard/did_you_know', array("packageHandle" => "glossary_list"), 'glossary_list'); ?>
