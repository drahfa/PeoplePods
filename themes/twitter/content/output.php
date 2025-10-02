<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/output.php
* Default output template for a piece of content
* Use this file as a basis for your custom content templates
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/themes
/**********************************************/

$heartStack = $doc->POD->getPeopleByFavorite($doc);
$heartCount = $heartStack ? $heartStack->totalCount() : 0;
?>

<article class="tw-card tw-article">
		<header>
			<h1><a href="<?php  $doc->write('permalink'); ?>" title="<?php  $doc->write('headline'); ?>"><?php  $doc->write('headline'); ?></a></h1>
			<?php  if ($doc->get('privacy')=="friends_only") { ?>
				<span class="privacy friends_only_option">Friends Only</span>
			<?php  } else if ($doc->get('privacy')=="group_only") { ?>
				<span class="privacy group_only_option">Group Members Only</span>
			<?php  } else if ($doc->get('privacy')=="owner_only") { ?>
				<span class="privacy owner_only_option">Only you can see this.</span>
			<?php  } ?>

		</header>
			
			<?php  if ($doc->get('link')) { ?>
				<p>View Link: <a href="<?php  $doc->write('link'); ?>"><?php  $doc->write('link'); ?></a></p>
			<?php  } ?>		

			<?php  if ($doc->get('video')) {
				if ($embed = $POD->GetVideoEmbedCode($doc->get('video'),530,400,'true','always')) { 
					echo $embed; 
				} else { ?>
					<p>Watch Video: <a href="<?php  $doc->write('video'); ?>"><?php  $doc->write('video'); ?></a></p>
				<?php  }
			} ?>
			<?php  if ($img = $doc->files()->contains('file_name','img')) { ?>
				<p class="post_image"><img src="<?php  $img->write('resized'); ?>" /></p>
			<?php  } ?>	
			<?php  if ($doc->get('body')) { 
				$doc->writeFormatted('body');
			} ?>	
											
			<?php  if ($doc->tags()->count() > 0){ ?>
				<p>
					<img src="<?php  $POD->templateDir(); ?>/img/tag_pink.png" alt="Tags" align="absmiddle" />
					<?php  $doc->tags()->output('tag',null,null); ?>
				</p>
			<?php  } ?>	
    <footer class="tw-article__meta">
        <span class="tw-tweet__meta">
            Posted <?php echo date('F j, Y g:i a', strtotime($doc->get('date'))); ?>
        </span>
    </footer>
	</article>	

<?php  if ($POD->isAuthenticated()) {  ?>
    <section class="tw-card tw-article-tools">
        <div class="tw-article-actions">
            <a href="#toggleFlag" data-flag="favorite" data-active="❤️ <?= $heartCount; ?>" title="Show appreciation" data-inactive="🤍 <?= $heartCount; ?>" data-content="<?= $doc->id; ?>" class="heartLink tw-pill tw-pill--outline <?php  if ($doc->hasFlag('favorite',$POD->currentUser())) {?>active<?php  } ?>"><?php echo $doc->hasFlag('favorite',$POD->currentUser()) ? '❤️ ' : '🤍 '; echo $heartCount; ?></a>
            <?php  if ($doc->isEditable()) { ?>
                <a href="<?php  $doc->write('editlink'); ?>" title="Edit this post" class="tw-pill">✏️ Edit</a>
            <?php  } ?>
        </div>
    </section>
<?php  } ?>

<section class="tw-card tw-comments">
		<div id="comments">
			<?php  while ($comment = $doc->comments()->getNext()) { $comment->output(); } ?>
		</div>
		<?php  $doc->output('comment.form'); ?>
</section>

<?php  $metaCards = array(); ?>

<?php  ob_start(); ?>
	<?php  $doc->author()->output('author_info'); ?>
<?php  $metaCards['author'] = ob_get_clean(); ?>

<?php  ob_start(); ?>
	<section class="post_stream_navigation">
		<header>
			<p id="post_date">Posted on <?php  echo date_format(date_create($doc->get('date')),'l, M jS'); ?> (<?php  $doc->write('timesince'); ?>)</p>
		</header>
		<?php 
			$previous = $POD->getContents(array('userId'=>$doc->author('id'),'id:lt'=>$doc->get('id')),'d.id DESC',1);
			if ($previous->success() && $previous->count() > 0) {
				$previous = $previous->getNext(); ?>
				<a href="<?php  $previous->write('permalink');?>" class="post_previous"><strong>&#171;&nbsp;Previous</strong> <?php  echo $POD->shorten($previous->get('headline'),100); ?></a>
		<?php  } 
			$next = $POD->getContents(array('userId'=>$doc->author('id'),'id:gt'=>$doc->get('id')),'d.id ASC',1);
			if ($next->success() && $next->count() > 0) {
				$next = $next->getNext(); ?>
				<a href="<?php  $next->write('permalink');?>" class="post_next"><strong>&#187;&nbsp;Next</strong> <?php   echo $POD->shorten($next->get('headline'),80); ?></a>
		<?php  } ?>
	</section>
<?php  $metaCards['navigation'] = ob_get_clean(); ?>

<?php  if ($doc->group()) { ob_start(); ?>
	<section class="post_stream_navigation">
		<header>
			<p>This is part of <?php  $doc->group()->permalink(); ?>.</p>
		</header>
		<?php 
			$previous = $POD->getContents(array('groupId'=>$doc->group('id'),'id:lt'=>$doc->get('id')),'d.id DESC',1);
			if ($previous->success() && $previous->count() > 0) { $previous = $previous->getNext(); ?>
				<a href="<?php  $previous->write('permalink');?>" class="post_previous"><strong>&#171;&nbsp;Previous</strong> <?php  echo $POD->shorten($previous->get('headline'),100); ?></a>
		<?php  } 
			$next = $POD->getContents(array('groupId'=>$doc->group('id'),'id:gt'=>$doc->get('id')),'d.id ASC',1);
			if ($next->success() && $next->count() > 0) { $next = $next->getNext(); ?>
				<a href="<?php  $next->write('permalink');?>" class="post_next"><strong>&#187;&nbsp;Next</strong> <?php   echo $POD->shorten($next->get('headline'),80); ?></a>
		<?php  } ?>
	</section>
<?php  $metaCards['group'] = ob_get_clean(); } ?>

<?php  ob_start(); ?>
	<?php   if ($heartCount > 0) {
			$heartStack->output('short','header','footer',$heartCount . $POD->pluralize($heartCount,' Heart',' Hearts'));
		} ?>
<?php  $metaCards['hearts'] = ob_get_clean(); ?>

<?php foreach ($metaCards as $snippet) { if (trim($snippet)!='') { ?>
    <section class="tw-card tw-article-meta">
        <?= $snippet; ?>
    </section>
<?php }} ?>
