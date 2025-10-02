<?php
/***********************************************
* Twitter style list item for content
**********************************************/
?>
<li class="tw-tweet content_<?php $doc->write('type'); ?>" id="content<?php $doc->write('id'); ?>">
    <a class="tw-tweet__avatar" href="<?php $doc->author()->write('permalink'); ?>" aria-hidden="true">
        <?php $doc->author()->avatar(48); ?>
    </a>
    <?php $doc->output('short_body'); ?>
</li>
