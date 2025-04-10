<?php

namespace Concrete\Package\GlossaryList\Block\GlossaryList;

use Concrete\Core\Block\BlockController;
use Concrete\Core\Support\Facade\Application;
use Page;

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

    public function getBlockTypeDescription()
    {
        return t("Block Element for displaying a glossary.");
    }

    public function getBlockTypeName()
    {
        return t("Glossary List");
    }

    public function on_start()
    {
        if (!$this->app instanceof \Concrete\Core\Application\Application) {
            $this->app = Application::getFacadeApplication();
        }

        parent::on_start();
    }

    public function view()
    {
        $groupedItems = [];

        $items = $this->getGlossaryItems();

        if (is_array($items) && count($items) > 0) {
            asort($items);

            foreach ($items as $itemUrl => $itemName) {
                $firstLetter = strtoupper(mb_substr($itemName, 0, 1, 'utf-8'));

                $groupedItems[$firstLetter][$itemUrl] = $itemName;
            }
        }

        $this->set("groupedItems", $groupedItems);
        $this->set("uniqueIdentifier", $this->app->make('helper/validation/identifier')->getString(18));
    }

    public function registerViewAssets($outputContent = '')
    {
        $this->requireAsset('javascript', 'jquery');
    }

    /**
     *
     * @return string
     */
    public function getSearchableContent()
    {
        $items = $this->getGlossaryItems();

        $content = "";

        if (is_array($items) && count($items) > 0) {
            foreach ($items as $item) {
                $content .= " " . $item;
            }
        }

        return $content;
    }

    public function add()
    {
        $this->initDefaults();
        $this->addOrEdit();
    }

    public function edit()
    {
        $this->addOrEdit();
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function validate($args)
    {
        self::on_start();

        $errorHelper = $this->app->make('helper/validation/error');

        if (intval($args["rootPageId"]) === 0 || is_object(Page::getById($args["rootPageId"])) === false) {
            $errorHelper->add(t("The field %s is invalid.", t("Root Page")));
        }

        $colors = [
            "itemColor" => t("Item Color"),
            "headlineColor" => t("Headline Color"),
            "navItemColor" => t("Navigation Item Color"),
            "navItemColorHover" => t("Navigation Item Color (Hover)")
        ];

        foreach ($colors as $varName => $label) {
            if (!isset($args[$varName]) || $args[$varName] == "") {
                $errorHelper->add(t("The field %s is invalid.", $label));
            }
        }

        return $errorHelper;
    }

    /**
     * @return array
     */
    private function getGlossaryItems()
    {
        $navHelper = $this->app->make('helper/navigation');

        $items = [];

        $rootPage = Page::getById($this->rootPageId);

        if (is_object($rootPage)) {
            foreach ($rootPage->getCollectionChildren() as $childPage) {
                $items[$navHelper::getLinkToCollection($childPage)] = $childPage->getCollectionName();
            }
        }

        return $items;
    }

    private function initDefaults()
    {
        $this->set("itemColor", "#000000");
        $this->set("headlineColor", "#000000");
        $this->set("navItemColor", "#000000");
        $this->set("navItemColorHover", "#75ca20");
    }

    private function addOrEdit()
    {
        $this->set("app", $this->app);
    }

}
