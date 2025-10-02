        </main>

        <aside class="tw-right-rail">
        <?php if ($POD->isAuthenticated()) { ?>
            <section class="tw-card">
                <h2>Who to follow</h2>
                <?php $suggestions = $POD->getPeople(null,'RAND()',3); ?>
                <?php if ($suggestions && $suggestions->success() && $suggestions->totalCount() > 0) { ?>
                    <ul class="tw-suggestions">
                        <?php while ($person = $suggestions->getNext()) { ?>
                            <li>
                                <a class="tw-avatar" href="<?php $person->write('permalink'); ?>"><?php $person->avatar(32); ?></a>
                                <div>
                                    <a class="tw-link" href="<?php $person->write('permalink'); ?>"><?php $person->write('nick'); ?></a>
                                    <span>@<?php echo strtolower(preg_replace('/\s+/','',$person->get('nick'))); ?></span>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p class="tw-muted">Invite your friends to get suggestions.</p>
                <?php } ?>
            </section>
        <?php } ?>

        <section class="tw-card tw-footer-links">
            <a href="<?php $POD->siteRoot(); ?>/about">About</a>
            <a href="<?php $POD->siteRoot(); ?>/help">Help Center</a>
            <a href="<?php $POD->siteRoot(); ?>/terms">Terms</a>
            <a href="<?php $POD->siteRoot(); ?>/privacy">Privacy</a>
            <span>&copy; <?php echo date('Y'); ?> <?php $POD->siteName(); ?></span>
        </section>
        </aside>
    </div>
</body>
</html>
