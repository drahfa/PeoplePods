<div class="comment">
	<p><a href="<?php  $POD->podRoot(); ?>/admin/people/?id=<?php  $comment->author()->write('id'); ?>"><?php  $comment->author()->write('nick'); ?></a> left a comment on 		<?php  if ($comment->parent()->TYPE=='content') { ?>
			<a href="<?php  $POD->podRoot(); ?>/admin/content/?id=<?= $comment->parent()->id; ?>"><?= $comment->parent()->headline; ?></a>
		<?php  } else { ?>
			<a href="<?php  $POD->podRoot(); ?>/admin/people/?id=<?= $comment->parent()->id; ?>"><?= $comment->parent()->nick; ?></a>
		<?php  } ?>, (<a href="<?= $comment->parent()->permalink; ?>#<?= $comment->id; ?>"><?= $POD->timesince($comment->get('minutes')); ?></a>)</p>
	<p><?php  $comment->writeFormatted('comment'); ?></p>
	<p><a href="<?php  $POD->podRoot(); ?>/admin/comments/?id=<?= $comment->id; ?>">Edit</a> | <a href="<?php  $POD->podRoot(); ?>/admin/comments/?delete=<?= $comment->id; ?>" onclick="return confirm('Are you sure you want to permanently delete this comment?');">Delete</a></p>
</div>