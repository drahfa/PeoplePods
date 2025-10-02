<?php
/***********************************************
* Twitter style short body for content listings
**********************************************/
?>
    <article class="tw-tweet__body">
        <header class="tw-tweet__head">
            <a class="tw-tweet__name" href="<?php $doc->author()->write('permalink'); ?>"><?php $doc->author()->write('nick'); ?></a>
            <span class="tw-tweet__meta">
                @<?php echo strtolower(preg_replace('/\s+/', '', $doc->author()->get('nick'))); ?>
                &bull;
                <a href="<?php $doc->write('permalink'); ?>" class="tw-tweet__time"><?php $doc->write('timesince'); ?></a>
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
                <a href="<?php $doc->write('permalink'); ?>#comments">💬 <?php echo $doc->comments()->totalCount(); ?></a>
            </span>
            <?php if ($doc->POD->isAuthenticated()) { ?>
                <span>
                    <a href="#toggleFlag" data-flag="watching" data-active="Tracking" data-inactive="Track" data-content="<?= $doc->id; ?>" class="trackingLink <?php if ($doc->hasFlag('watching', $POD->currentUser())) {?>active<?php } ?>">👀 Track</a>
                </span>
                <?php if ($doc->isEditable()) { ?>
                    <span><a href="<?php $doc->write('editlink'); ?>">✏️ Edit</a></span>
                <?php } ?>
            <?php } ?>
        </footer>
    </article>
