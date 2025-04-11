<?php

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\Form\Service\Form;
use Concrete\Core\Form\Service\Widget\PageSelector;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\View\View;

$app = Application::getFacadeApplication();

/** @var Form $form */
/** @noinspection PhpUnhandledExceptionInspection */
$form = $app->make(Form::class);
/** @var PageSelector $pageSelector */
/** @noinspection PhpUnhandledExceptionInspection */
$pageSelector = $app->make(PageSelector::class);

/** @var int $rootPageId */

/** @noinspection PhpUnhandledExceptionInspection */
View::element("dashboard/help_blocktypes", [], "glossary_list");

?>

<div class="form-group">
    <?php echo $form->label("rootPageId", t("Root Page")); ?>
    <?php echo $pageSelector->selectPage("rootPageId", $rootPageId); ?>
</div>