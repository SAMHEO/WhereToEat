<ul id="dining-list">
    <?php foreach ($dinings as $dining) : ?>
        <li onClick="selectDining('<?php echo $dining->dining_name; ?>');"><?php echo $dining->dining_name; ?></li>
    <?php endforeach; ?>
</ul