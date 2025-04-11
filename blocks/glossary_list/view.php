<?php

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\View\View;

/** @var array $items */

/** @noinspection PhpUnhandledExceptionInspection */
View::element("glossary_list", ["items" => $items], "glossary_list");