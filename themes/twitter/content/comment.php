<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/comment.php
* Default output template for comments
* Used by core_usercontent
* 
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/
?>
<a name="<?php  $comment->write('id'); ?>"></a>
<div class="tw-comment" id="comment<?php  $comment->write('id'); ?>">
    <div class="tw-comment__avatar">
        <?php  if ($img = $comment->author()->files()->contains('file_name','img')) { ?>
            <img src="<?php $img->write('thumbnail'); ?>" alt="<?php $comment->author()->write('nick'); ?>" />
        <?php  } else { ?>
            <?php  $comment->author()->avatar(48); ?>
        <?php  } ?>
    </div>
    <div class="tw-comment__body">
        <header class="tw-comment__meta">
            <span class="tw-comment__author"><?php  $comment->author()->write('nick'); ?></span>
            <span class="tw-comment__time"><?php  echo date('M j, Y g:i a', strtotime($comment->get('date'))); ?></span>
            <?php  if ($comment->POD->isAuthenticated() && ($comment->parent('userId') == $comment->POD->currentUser()->get('id') || $comment->get('userId') == $comment->POD->currentUser()->get('id'))) { ?>
                <a class="tw-comment__delete" href="#deleteComment" data-comment="<?php  $comment->write('id'); ?>" title="Remove comment">✕</a>
            <?php  } ?>
        </header>
        <div class="tw-comment__text">
            <?php  $comment->writeFormatted('comment'); ?>
        </div>
        <footer class="tw-comment__actions">
            <a href="#reply" data-comment="<?= $comment->id; ?>" data-author="<?= htmlspecialchars($comment->author()->nick); ?>">Reply</a>
        </footer>
    </div>
</div>
