<?php
/***********************************************
* Twitter-inspired PeoplePods Theme Header
**********************************************/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo $pagetitle ? $pagetitle . ' / ' . $POD->siteName(false) : $POD->siteName(false); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="<?php $POD->templateDir(); ?>/img/peoplepods_favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php $POD->templateDir(); ?>/img/peoplepods_favicon.png" type="image/x-icon">

    <script src="<?php $POD->templateDir(); ?>/js/jquery-1.4.2.min.js"></script>
    <script src="<?php $POD->templateDir(); ?>/js/jquery.validate.min.js"></script>
    <script src="<?php $POD->templateDir(); ?>/js/jquery-tagsinput/jquery.tagsinput.js"></script>
    <script src="<?php $POD->templateDir(); ?>/javascript.js"></script>

    <?php $POD->extraJS(); ?>
    <link rel="stylesheet" href="<?php $POD->templateDir(); ?>/styles.css" media="screen" />
    <?php $POD->extraCSS(); ?>

    <?php if ($feedurl) { ?>
        <link rel="alternate" type="application/rss+xml" title="RSS: <?php echo $pagetitle ? $pagetitle . ' / ' . $POD->siteName(false) : $POD->siteName(false); ?>" href="<?php echo $feedurl; ?>" />
    <?php } elseif ($POD->libOptions('enable_core_feeds')) { ?>
        <link rel="alternate" type="application/rss+xml" title="RSS: <?php $POD->siteName(); ?>" href="<?php $POD->siteRoot(); ?>/feeds" />
    <?php } ?>

    <script>
        var siteRoot = "<?php $POD->siteRoot(); ?>";
        var podRoot = "<?php $POD->podRoot(); ?>";
        var themeRoot = "<?php $POD->templateDir(); ?>";
        var API = siteRoot + "/api/2";
    </script>
</head>
<body>
    <header class="tw-header">
        <div class="tw-nav">
            <div class="tw-nav__col tw-nav__brand">
                <a class="tw-logo" href="<?php $POD->siteRoot(); ?>" aria-label="Home">
                    <span class="tw-logo__icon" aria-hidden="true">🐦</span>
                </a>
            </div>

            <?php if ($POD->isAuthenticated()) { ?>
                <nav class="tw-nav__col tw-nav__tabs" aria-label="Primary">
                    <a class="tw-tab<?php if ($_SERVER['REQUEST_URI'] == $POD->siteRoot(false) . '/') { echo ' is-active'; } ?>" href="<?php $POD->siteRoot(); ?>">Home</a>
                    <?php if ($POD->libOptions('enable_contenttype_document_list')) { ?>
                        <a class="tw-tab" href="<?php $POD->siteRoot(); ?>/show">Explore</a>
                    <?php } ?>
                    <?php if ($POD->libOptions('enable_core_groups')) { ?>
                        <a class="tw-tab" href="<?php $POD->siteRoot(); ?>/groups">Communities</a>
                    <?php } ?>
                    <?php if ($POD->libOptions('enable_core_private_messaging')) { ?>
                        <?php $inbox = $POD->getInbox(); ?>
                        <a class="tw-tab" href="<?php $POD->siteRoot(); ?>/inbox">
                            Messages<?php if ($inbox->unreadCount() > 0) { echo ' <span class="tw-pill">' . $inbox->unreadCount() . '</span>'; } ?>
                        </a>
                    <?php } ?>
                    <?php if ($POD->currentUser()->get('adminUser')) { ?>
                        <a class="tw-tab" href="<?php $POD->podRoot(); ?>/admin">Admin</a>
                    <?php } ?>
                </nav>
            <?php } ?>

            <div class="tw-nav__col tw-nav__search">
                <?php if ($POD->isEnabled('core_search')) { ?>
                    <form method="get" action="<?php $POD->siteRoot(); ?>/search" class="tw-search" role="search">
                        <input type="search" name="q" placeholder="Search PeoplePods" value="<?php echo htmlspecialchars(@$_GET['q']); ?>" aria-label="Search" />
                    </form>
                <?php } ?>
            </div>

            <div class="tw-nav__col tw-nav__user">
                <?php if ($POD->isAuthenticated()) { ?>
                    <a class="tw-avatar" href="<?php $POD->currentUser()->write('permalink'); ?>">
                        <?php $POD->currentUser()->avatar(48); ?>
                    </a>
                    <div class="tw-user-meta">
                        <strong><?php $POD->currentUser()->write('nick'); ?></strong>
                        <span>@<?php echo strtolower(preg_replace('/\s+/', '', $POD->currentUser()->get('nick'))); ?></span>
                    </div>
                    <a class="tw-pill tw-pill--outline" href="<?php $POD->siteRoot(); ?>/logout">Log out</a>
                <?php } else { ?>
                    <a class="tw-pill" href="<?php $POD->siteRoot(); ?>/login">Log in</a>
                    <?php if ($POD->libOptions('enable_core_authentication_creation')) { ?>
                        <a class="tw-pill tw-pill--outline" href="<?php $POD->siteRoot(); ?>/join">Sign up</a>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </header>

    <?php if (sizeof($POD->messages()) > 0) { ?>
        <section class="tw-system" role="status">
            <?php foreach ($POD->messages() as $message) { ?>
                <div class="tw-toast"><?= $message; ?></div>
            <?php } ?>
        </section>
    <?php } ?>

    <div class="tw-shell">
        <aside class="tw-left-rail">
            <nav aria-label="Primary navigation">
                <a class="tw-left-link" href="<?php $POD->siteRoot(); ?>">🏠 Home</a>
                <?php if ($POD->libOptions('enable_contenttype_document_list')) { ?>
                    <a class="tw-left-link" href="<?php $POD->siteRoot(); ?>/show">🔍 Explore</a>
                <?php } ?>
                <?php if ($POD->libOptions('enable_core_groups')) { ?>
                    <a class="tw-left-link" href="<?php $POD->siteRoot(); ?>/groups">👥 Communities</a>
                <?php } ?>
                <?php if ($POD->libOptions('enable_core_private_messaging')) { ?>
                    <a class="tw-left-link" href="<?php $POD->siteRoot(); ?>/inbox">✉️ Messages</a>
                <?php } ?>
                <?php if ($POD->isAuthenticated()) { ?>
                    <a class="tw-left-link" href="<?php $POD->currentUser()->write('permalink'); ?>">🙋 Profile</a>
                <?php } ?>
                <?php if ($POD->currentUser() && $POD->currentUser()->get('adminUser')) { ?>
                    <a class="tw-left-link" href="<?php $POD->podRoot(); ?>/admin">🛠 Admin</a>
                <?php } ?>
                <?php if (!$POD->isAuthenticated() && $POD->libOptions('enable_core_authentication_creation')) { ?>
                    <a class="tw-left-link tw-left-link--cta" href="<?php $POD->siteRoot(); ?>/join">Create account</a>
                <?php } ?>
            </nav>
        </aside>

        <main class="tw-feed" role="main">
