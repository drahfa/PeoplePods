<?php
/***********************************************
* Twitter style list item for content
**********************************************/
?>
<li class="tw-tweet content_<?php $doc->write('type'); ?>" id="content<?php $doc->write('id'); ?>">
    <?php $doc->output('short_body'); ?>
</li>
