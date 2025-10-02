<?php
// Twitter theme dashboard sidebar: render inside right rail
?>
<section class="tw-card">
    <?php $POD->currentUser()->output('avatar'); ?>
    <div class="tw-user-meta">
        <strong><?php $POD->currentUser()->write('nick'); ?></strong>
        <span>@<?php echo strtolower(preg_replace('/\s+/','',$POD->currentUser()->get('nick'))); ?></span>
    </div>
</section>

<ul class="tw-card tw-dashboard-links">
    <li class="dashboard_navigator dashboard_active"><a href="<?php $POD->siteRoot(); ?>">New Stuff</a></li>
    <li class="dashboard_navigator sub_option">
        You are following <a href="<?php $POD->siteRoot(); ?>/friends"><?php echo $POD->currentUser()->friends()->totalCount(); ?> people</a>
    </li>
    <li class="dashboard_navigator sub_option">
        <a href="<?php $POD->siteRoot(); ?>/friends/followers"><?php echo $POD->currentUser()->followers()->totalCount(); ?> people</a> follow you
    </li>
    <li class="dashboard_navigator sub_option">
        <a href="<?php $POD->siteRoot(); ?>/friends/recommended">Meet some new people »</a>
    </li>
    <li class="dashboard_navigator dashboard_navigator_last"><a href="<?php $POD->siteRoot(); ?>/replies">Activity</a></li>
</ul>

<div class="tw-card" id="activity_stream_sidebar">
    <h3>Recent Activity</h3>
    <ul>
        <?php $POD->output('sidebars/activity_stream'); ?>
    </ul>
</div>

<div class="tw-card" id="ad_unit_sidebar">
    Place Ad Code Here
</div>

<div class="tw-card" id="tag_cloud_sidebar">
    <?php $POD->output('sidebars/tag_cloud'); ?>
</div>

<div class="tw-card" id="recent_visitors_sidebar">
    <h3>Recent Visitors</h3>
    <?php $POD->output('sidebars/recent_visitors'); ?>
</div>
