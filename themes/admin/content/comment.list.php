<tr class="<?php  if ($this->isEvenItem) {?>even<?php  } else { ?>odd<?php  } ?>">
	<td valign="top" align="left">
		<a href="?id=<?= $comment->id; ?>"><?= $comment->shorten('comment',150); ?></a>
	</td>
	<td valign="top" align="left">
		<a href="<?php  $POD->podRoot(); ?>/admin/people/?id=<?php  $comment->author()->write('id'); ?>"><?php  $comment->author()->write('nick'); ?></a>
	</td>
	<td valign="top" align="left">
		<?php  if ($comment->parent()->TYPE=='content') { ?>
			<a href="<?php  $POD->podRoot(); ?>/admin/content/?id=<?= $comment->parent()->id; ?>"><?= $comment->parent()->headline; ?></a>
		<?php  } else { ?>
			<a href="<?php  $POD->podRoot(); ?>/admin/people/?id=<?= $comment->parent()->id; ?>"><?= $comment->parent()->nick; ?></a>
		<?php  } ?>
	</td>
	<td>
		<?= date('Y-m-d H:i',strtotime($comment->get('date'))); ?>
	</td>
</tr>