<?php

namespace Concrete\Package\GlossaryList\Block\GlossaryList;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Html\Service\Navigation;
use Concrete\Core\Page\Page;

class Controller extends BlockController
{
    public $helpers = ["form"];

    protected $btExportFileColumns = [];
    protected $btDefaultSet = 'navigation';
    protected $btTable = 'btGlossaryList';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 500;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputLifetime = 300;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;

    public function getBlockTypeDescription(): string
    {
        return t("Block Element for displaying a glossary.");
    }

    public function getBlockTypeName(): string
    {
        return t("Glossary List");
    }

    public function view()
    {
        $items = $this->getGlossaryItems();
        $this->set("items", $items);
    }

    public function getSearchableContent(): string
    {
        $items = $this->getGlossaryItems();

        $content = "";

        if (count($items) > 0) {
            foreach ($items as $item) {
                $content .= " " . $item;
            }
        }

        return $content;
    }

    public function add()
    {
        $this->set("rootPageId", null);
    }

    public function validate($args): ErrorList
    {
        $errorList = new ErrorList();

        if (empty($args["rootPageId"])) {
            $errorList->add(t("You need to enter a valid page."));
        }

        return $errorList;
    }

    private function getGlossaryItems(): array
    {
        /** @var Navigation $navHelper */
        /** @noinspection PhpUnhandledExceptionInspection */
        $navHelper = $this->app->make(Navigation::class);

        $items = [];

        $rootPage = Page::getById($this->get("rootPageId"));

        if ($rootPage instanceof Page && !$rootPage->isError()) {
            foreach ($rootPage->getCollectionChildren() as $childPage) {
                /** @noinspection PhpParamsInspection */
                $items[$navHelper->getLinkToCollection($childPage)] = $childPage->getCollectionName();
            }
        }

        return $items;
    }
}
