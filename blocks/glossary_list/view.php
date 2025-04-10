<?php

defined('C5_EXECUTE') or die('Access denied');

?>

<?php if (count($groupedItems) === 0): ?>
    <div class="alert alert-warning">
        <?php echo t("No items available."); ?>
    </div>
<?php else: ?>
    <div id="glossary-<?php echo $uniqueIdentifier; ?>" class="glossary-list">
        <div class="glossary-agenda">
            <ul>
                <?php foreach($groupedItems as $firstLetter => $items): ?>
                    <li>
                        <a href="javascript:void(0);" data-first-letter="<?php echo $firstLetter; ?>">
                            <?php echo $firstLetter; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="glossary-items">
            <?php foreach($groupedItems as $firstLetter => $items): ?>
                <div class="glossary-group" data-first-letter="<?php echo $firstLetter; ?>">
                    <h2>
                        <?php echo $firstLetter; ?>
                    </h2>

                    <ul>
                        <?php foreach($items as $itemUrl => $itemName): ?>

                            <li>
                                <a href="<?php echo $itemUrl; ?>">
                                    <?php echo $itemName; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <style type="text/css">
        #glossary-<?php echo $uniqueIdentifier; ?> .glossary-agenda a {
            color: <?php echo $itemColor; ?>;
            border-color: <?php echo $itemColor; ?>;
        }

        #glossary-<?php echo $uniqueIdentifier; ?> .glossary-agenda a:hover {
            color: <?php echo $navItemColorHover; ?>;
            border-color: <?php echo $navItemColorHover; ?>;
        }

        #glossary-<?php echo $uniqueIdentifier; ?> .glossary-items .glossary-group h2 {
            color: <?php echo $headlineColor; ?>;
            border-color: <?php echo $headlineColor; ?>;
        }

        #glossary-<?php echo $uniqueIdentifier; ?> .glossary-items .glossary-group ul li a {
            color: <?php echo $itemColor; ?>;
        }
    </style>
<?php endif; ?>