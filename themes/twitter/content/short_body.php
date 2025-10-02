<?php
/***********************************************
* Twitter style short body for content listings
**********************************************/
$commentWrapper = 'tw-comments-' . $doc->get('id');
$heartStack = $doc->POD->getPeopleByFavorite($doc);
$heartCount = $heartStack ? $heartStack->totalCount() : 0;
?>
    <article class="tw-tweet__body">
        <header class="tw-tweet__head">
            <a class="tw-tweet__name" href="<?php $doc->author()->write('permalink'); ?>"><?php $doc->author()->write('nick'); ?></a>
            <span class="tw-tweet__meta">
                @<?php echo strtolower(preg_replace('/\s+/', '', $doc->author()->get('nick'))); ?>
                &bull;
                <a href="<?php $doc->write('permalink'); ?>" class="tw-tweet__time" title="<?php echo date('F j, Y g:i a', strtotime($doc->get('date'))); ?>">
                    <?php echo date('M j, Y g:i a', strtotime($doc->get('date'))); ?>
                </a>
            </span>
        </header>

        <a class="tw-tweet__title" href="<?php $doc->write('permalink'); ?>" title="<?php $doc->write('headline'); ?>"><?php $doc->write('headline'); ?></a>

        <?php if ($doc->get('video')) {
            if ($embed = $POD->GetVideoEmbedCode($doc->get('video'), 530, 400, 'true', 'always')) {
                echo '<div class="tw-tweet__media">' . $embed . '</div>';
            } else { ?>
                <p class="tw-tweet__link">Watch: <a href="<?php $doc->write('video'); ?>"><?php $doc->write('video'); ?></a></p>
            <?php }
        } ?>

        <?php if ($img = $doc->files()->contains('file_name', 'img')) { ?>
            <a class="tw-tweet__media" href="<?php $doc->write('permalink'); ?>">
                <img src="<?php $img->write('resized'); ?>" alt="" />
            </a>
        <?php } ?>

        <?php if ($doc->get('body')) {
            $teaser = strip_tags($doc->get('body'));
            $teaser = $POD->shorten($teaser, 240);
            if ($teaser) { ?>
                <p class="tw-tweet__text"><?php echo nl2br(htmlentities($teaser)); ?></p>
            <?php }
        } ?>

        <?php if ($doc->get('link')) { ?>
            <p class="tw-tweet__link">Link: <a href="<?php $doc->write('link'); ?>"><?php $doc->write('link'); ?></a></p>
        <?php } ?>

        <footer class="tw-tweet__actions">
            <span>
                <a href="#" class="tw-reply-toggle" data-target="#<?= $commentWrapper; ?>">💬 <?php echo $doc->comments()->totalCount(); ?></a>
            </span>
            <?php if ($doc->POD->isAuthenticated()) { ?>
                <span>
                    <a href="#toggleFlag" data-flag="favorite" data-active="❤️ <?= $heartCount; ?>" data-inactive="🤍 <?= $heartCount; ?>" data-content="<?= $doc->id; ?>" class="heartLink <?php if ($doc->hasFlag('favorite', $POD->currentUser())) {?>active<?php } ?>"><?php echo $doc->hasFlag('favorite', $POD->currentUser()) ? '❤️ ' : '🤍 '; echo $heartCount; ?></a>
                </span>
                <?php if ($doc->isEditable()) { ?>
                    <span><a href="<?php $doc->write('editlink'); ?>">✏️ Edit</a></span>
                <?php } ?>
            <?php } ?>
        </footer>
    </article>

    <?php $doc->comments()->reset(); ?>
    <div class="tw-tweet__comments" id="<?= $commentWrapper; ?>" style="display:none;">
        <div class="tw-comments-list" id="<?= $commentWrapper; ?>_list">
            <?php while ($comment = $doc->comments()->getNext()) { $comment->output(); } ?>
        </div>
        <?php if ($POD->isAuthenticated()) { ?>
            <div class="tw-comment-form-wrapper tw-comment-form-wrapper--inline">
                <div class="tw-comment-form tw-comment-form--inline">
                    <div class="tw-comment-form__avatar">
                        <?php if ($img = $POD->currentUser()->files()->contains('file_name','img')) { ?>
                            <img src="<?php $img->write('thumbnail'); ?>" alt="<?php $POD->currentUser()->write('nick'); ?>" />
                        <?php } else { ?>
                            <?php $POD->currentUser()->avatar(48); ?>
                        <?php } ?>
                    </div>
                    <form method="post" action="#addComment" class="tw-comment-form__inner" data-comments="#<?= $commentWrapper; ?>_list" data-content="<?= $doc->id; ?>">
                        <textarea name="comment" class="expanding" rows="2" placeholder="Tweet your reply"></textarea>
                        <div class="tw-comment-form__actions">
                            <button type="submit" class="tw-pill">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <p class="tw-muted"><a href="<?php $POD->siteRoot(); ?>/login">Log in</a> to reply.</p>
        <?php } ?>
    </div>
