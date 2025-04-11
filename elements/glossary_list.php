<?php

defined('C5_EXECUTE') or die('Access denied');

use Concrete\Core\View\View;

/** @var array $items */

$items = $items ?? [];

$groupedItems = [];

if (count($items) > 0) {
    asort($items);

    foreach ($items as $itemUrl => $itemName) {
        $firstLetter = strtoupper(mb_substr($itemName, 0, 1, 'utf-8'));

        $groupedItems[$firstLetter][$itemUrl] = $itemName;
    }
}

View::getInstance()->requireAsset("glossary-list");
?>

<?php if (count($groupedItems) === 0) { ?>
    <p>
        <?php echo t("No items available."); ?>
    </p>
<?php } else { ?>
    <div class="glossary-list">
        <div class="glossary-agenda">
            <ul>
                <?php foreach ($groupedItems as $firstLetter => $items) { ?>
                    <li>
                        <a href="javascript:void(0);" data-first-letter="<?php echo $firstLetter; ?>">
                            <?php echo $firstLetter; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="glossary-items">
            <?php foreach ($groupedItems as $firstLetter => $items) { ?>
                <div class="glossary-group" data-first-letter="<?php echo $firstLetter; ?>">
                    <h2>
                        <?php echo $firstLetter; ?>
                    </h2>

                    <ul>
                        <?php foreach ($items as $itemUrl => $itemName) { ?>

                            <li>
                                <a href="<?php echo $itemUrl; ?>">
                                    <?php echo $itemName; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>