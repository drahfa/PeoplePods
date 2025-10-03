<?php
/***********************************************
* Twitter-inspired edit profile page
**********************************************/
?>

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
            <h1>Edit profile</h1>
            <p class="tw-muted">@<?php echo strtolower(preg_replace('/\s+/','',$user->get('nick'))); ?></p>
            <?php if ($user->get('verificationKey') != '') { ?>
                <div class="tw-alert">Your email is unverified. <a href="<?php $POD->siteRoot(); ?>/verify">Verify now</a>.</div>
            <?php } ?>
        </div>
    </div>

    <form id="edit_profile" method="post" action="<?php $POD->siteRoot(); ?>/editprofile" class="tw-form" enctype="multipart/form-data">
        <div class="tw-form__grid">
            <label for="nick">Username</label>
            <input class="required tw-input" maxlength="20" name="nick" id="nick" value="<?php $user->htmlspecialwrite('nick'); ?>" />

            <label for="email">Email</label>
            <input class="required email tw-input" name="email" id="email" value="<?php $user->htmlspecialwrite('email'); ?>" />

            <label for="img">Profile photo</label>
            <div class="tw-file-input">
                <input name="img" type="file" id="img" accept="image/*" />
                <?php if ($img) { ?>
                    <div class="tw-file-input__preview">
                        <img src="<?php $img->write('thumbnail'); ?>" alt="<?php $user->write('nick'); ?>" />
                        <a href="#deleteFile" data-file="<?= $img->id;?>" class="tw-pill tw-pill--outline">Remove</a>
                    </div>
                <?php } ?>
            </div>

            <label for="aboutme">Bio</label>
            <textarea name="aboutme" class="tw-input" id="aboutme" rows="4" placeholder="Tell the community about yourself"><?php $user->htmlspecialwrite('aboutme'); ?></textarea>

            <label for="tagline">Profile headline</label>
            <input class="tw-input" name="tagline" id="tagline" value="<?php $user->htmlspecialwrite('tagline'); ?>" />

            <label for="age">Age</label>
            <input class="tw-input" name="age" id="age" maxlength="5" value="<?php $user->htmlspecialwrite('age'); ?>" />

            <label for="sex">Gender</label>
            <input class="tw-input" name="sex" id="sex" maxlength="20" value="<?php $user->htmlspecialwrite('sex'); ?>" />

            <label for="location">Location</label>
            <input class="tw-input" name="location" maxlength="100" id="location" value="<?php $user->htmlspecialwrite('location'); ?>" />

            <label for="homepage">Website</label>
            <input class="tw-input" name="homepage" id="homepage" value="<?php $user->htmlspecialwrite('homepage'); ?>" placeholder="https://" />
        </div>

        <div class="tw-form__actions">
            <button type="submit" class="tw-pill">Save changes</button>
        </div>
    </form>
</section>

<section class="tw-card tw-profile-header">
    <h2>Change password</h2>
    <form id="change_password" method="post" action="<?php $POD->siteRoot(); ?>/editprofile" class="tw-form tw-form--narrow">
        <label for="password">New password</label>
        <input name="password" id="password" type="password" class="tw-input required" />
        <button class="tw-pill" type="submit">Set new password</button>
    </form>
</section>
