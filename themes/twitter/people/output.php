<?php
/***********************************************
* Twitter-styled profile output (content column only)
**********************************************/
?>
<div class="tw-profile-feed">
    <section class="tw-card tw-profile-header">
        <div class="tw-profile-header__top">
            <div class="tw-profile-header__avatar">
                <?php if ($img = $user->files()->contains('file_name','img')) { ?>
                    <img src="<?php $img->write('resized'); ?>" alt="<?php $user->write('nick'); ?>" />
                <?php } else { ?>
                    <?php $user->avatar(120); ?>
                <?php } ?>
            </div>
            <div class="tw-profile-header__meta">
                <h1><?php $user->write('nick'); ?></h1>
                <p class="tw-muted">@<?php echo strtolower(preg_replace('/\s+/','',$user->get('nick'))); ?></p>
                <?php if ($user->get('location')) { ?><p class="tw-muted">📍 <?php $user->write('location'); ?></p><?php } ?>
                <?php if ($user->get('homepage')) { ?><p><a class="tw-link" href="<?php $user->write('homepage'); ?>">Website</a></p><?php } ?>
            </div>
            <div class="tw-profile-header__actions">
                <?php if ($user->POD->isAuthenticated()) {
                    if ($user->POD->currentUser()->get('id') != $user->get('id')) { ?>
                        <a href="#toggleFlag" data-flag="friends" data-person="<?= $user->id; ?>" data-active="Following" data-inactive="Follow" class="tw-pill <?php if ($user->hasFlag('friends',$POD->currentUser())){?>active<?php } ?>">Follow</a>
                        <?php if ($user->POD->libOptions('enable_core_private_messaging')) { ?>
                            <a href="<?php $user->POD->siteRoot(); ?><?php echo $user->POD->libOptions('messagePath') ?>/<?php $user->write('stub'); ?>" class="tw-pill tw-pill--outline">Message</a>
                        <?php } ?>
                    <?php } else { ?>
                        <a href="<?php $user->POD->siteRoot(); ?>/editprofile" class="tw-pill">Edit profile</a>
                    <?php }
                } else { ?>
                    <a class="tw-pill tw-pill--outline" href="<?php $user->POD->siteRoot(); ?>/join">Join to follow</a>
                <?php } ?>
            </div>
        </div>
        <?php if ($user->get('aboutme')) { ?>
            <p class="tw-profile-header__bio"><?php echo $user->formatText('aboutme'); ?></p>
        <?php } ?>
        <div class="tw-profile-header__counts">
            <span><strong><?php echo $user->friends()->totalCount(); ?></strong> Following</span>
            <span><strong><?php echo $user->followers()->totalCount(); ?></strong> Followers</span>
            <?php if ($user->favorites()->totalCount() > 0) { ?>
                <span><a class="tw-link" href="<?php $user->POD->siteRoot(); ?>/lists/favorites/<?php $user->write('stub'); ?>">Favorites</a></span>
            <?php } ?>
        </div>
    </section>

    <?php if ($user->friends()->totalCount() > 0) { ?>
        <section class="tw-card tw-profile-following">
            <h3>Following</h3>
            <?php $user->friends()->output('short'); ?>
        </section>
    <?php } ?>

    <?php
        $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
        $docs = $user->POD->getContents(array('userId'=>$user->get('id')),null,20,$offset);
        $tagline = $user->get('tagline') ? $user->get('tagline') : ($user->get('nick') . "'s posts");
        $docs->output('short','header','pager',$tagline,$user->get('nick') . " hasn't posted anything yet.");
    ?>
</div>
