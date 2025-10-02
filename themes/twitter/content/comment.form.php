	<?php  if ($this->POD->isAuthenticated()) { ?>
		<div class="tw-comment-form-wrapper">
			<div class="tw-comment-form">
				<div class="tw-comment-form__avatar">
					<?php  if ($img = $POD->currentUser()->files()->contains('file_name','img')) { ?>
						<img src="<?php $img->write('thumbnail'); ?>" alt="<?php $POD->currentUser()->write('nick'); ?>" />
					<?php  } else { ?>
						<?php  $POD->currentUser()->avatar(48); ?>
					<?php  } ?>
				</div>
				<form method="post" id="add_comment" action="#addComment" data-comments="#comments" data-content="<?= $doc->id; ?>">
					<textarea name="comment" class="expanding" id="comment" rows="3" placeholder="Add a reply"></textarea>
					<div class="tw-comment-form__actions">
						<button type="submit" class="tw-pill">Reply</button>
					</div>
				</form>
			</div>
		</div>
	<?php  } else { ?>
		<div id="comment_form">
			<a name="reply"></a>
			<p>
				<a href="<?php  $POD->siteRoot(); ?>/join">Register for an account</a> to leave a comment.	
				If you've already got an account, <a href="<?php  $POD->siteRoot(); ?>/login">login here</a>.
			</p>
		</div>
	<?php  } ?>
