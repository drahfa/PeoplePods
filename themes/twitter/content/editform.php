<?php
/***********************************************
* This file is part of PeoplePods
* (c) xoxco, inc  
* http://peoplepods.net http://xoxco.com
*
* theme/content/editform.php
* Default content add/edit form used by the core_usercontent module
* Customizing the fields in this form will alter the information stored!
* Use this file as the basis for new content type forms
*
* Documentation for this pod can be found here:
* http://peoplepods.net/readme/new-content-type
/**********************************************/
?>
<section id="editform" class="tw-composer">
	<form class="valid tw-composer__form" action="<?php  $doc->write('editpath'); ?>" method="post" id="post_something"  enctype="multipart/form-data">
		<?php  if ($doc->get('id')) { ?>
			<input type="hidden" name="id" value="<?php  $doc->write('id'); ?>" />
			<input type="hidden" name="redirect" value="<?php  $doc->write('permalink'); ?>" />
		<?php  } else if ($doc->get('groupId')) { ?>
			<input type="hidden" name="redirect" value="<?php  $this->group()->write('permalink'); ?>" />
		<?php  } ?>
		<?php  if ($doc->get('groupId')) { ?>
			<input type="hidden" name="groupId" value="<?php  $doc->write('groupId'); ?>" />		
		<?php  } ?>
		<?php  if ($doc->get('type')) { ?>
			<input type="hidden" name="type" value="<?php  $doc->write('type'); ?>" />		
		<?php  } ?>
		
		<header class="tw-composer__header">
			<div class="tw-composer__actions" role="tablist">
				<button type="button" onclick="togglePostOption('body');" id="add_body">📝 Body</button>
				<button type="button" onclick="togglePostOption('photo');" id="add_photo">🖼 Image</button>
				<button type="button" onclick="togglePostOption('video');" id="add_video">🎬 Video</button>
				<button type="button" onclick="togglePostOption('link');" id="add_link">🔗 Link</button>
				<button type="button" onclick="togglePostOption('tags');" id="add_tags">🏷 Tags</button>
			</div>
		</header>

		<div class="tw-composer__primary">
			<textarea name="headline" id="headline" class="text expanding required" rows="3" placeholder="What’s happening?" required><?php  $doc->htmlspecialwrite('headline'); ?></textarea>
		</div>

		<div class="tw-composer__extras">
			<div class="post_extra" id="post_body" style="display:none;">
				<label for="body">Write more</label>
				<textarea name="body" id="body" class="htmlarea text" rows="6" placeholder="Add more detail... "><?php  $doc->htmlspecialwrite('body'); ?></textarea>
			</div>

			<div class="post_extra" id="post_photo" style="display:none;">
				<label for="img">Image</label>
				<input type="file" name="img" id="img" />
				<?php  if ($img = $doc->files()->contains('file_name','img')) { ?>
					<div id="file<?= $img->id; ?>" class="tw-composer__preview">
						<a href="<?= $img->original_file; ?>"><img src="<?php  $img->write('thumbnail'); ?>" alt="" /></a>
						<a class="tw-pill tw-pill--outline" href="#deleteFile" data-file="<?= $img->id;?>">Delete</a>
					</div>
				<?php  } ?>
			</div>

			<div class="post_extra" id="post_video" style="display:none;">
				<label for="video">Video URL</label>
				<input name="meta_video" id="video" value="<?php  $doc->htmlspecialwrite('video'); ?>" class="text" placeholder="Paste a YouTube, Vimeo, or other supported video link" />
			</div>

			<div class="post_extra" id="post_link" style="display:none;">
				<label for="link">Link URL</label>
				<input name="link" id="link" value="<?php  echo $doc->htmlspecialwrite('link'); ?>" class="text" placeholder="https://example.com" />
			</div>

			<div class="post_extra" id="post_tags" style="display:none;">
				<label for="tags">Tags</label>
				<input name="tags" id="tags" value="<?php  echo $doc->tagsAsString(); ?>" class="text" placeholder="Add tags separated by spaces" />
			</div>
		</div>

		<div class="tw-composer__footer">
			<input type="submit" id="editform_save" class="tw-pill" value="Post" />

			<?php 
				// if this is a new post, we need to give the option to set it friend only or group only
				if (!$doc->get('id')) { 
					if ($doc->group()) {
						if ($doc->group()->get('type')=="private") { ?>
							<input type="hidden" name="group_only" value="group_only" />
							<span class="tw-muted">Posts in this group will only be available to members.</span>
						<?php  } else { ?>
							<label class="tw-switch">
								<input type="checkbox" name="group_only" value="group_only" />
								<span>Group only</span>
							</label>
						<?php  } 
					} else { ?>
						<label class="tw-switch">
							<input type="checkbox" name="friends_only" value="friends_only" />
							<span>Friends only</span>
						</label>
					<?php  } 
				} else { 
					if ($doc->get('privacy')=="friends_only") { ?>
						<span class="tw-muted">This post is visible to friends only.</span>
					<?php  } else if ($doc->get('privacy')=="group_only") { ?>
						<span class="tw-muted">This post is only visible to other members of this group.</span>
					<?php  } 
				} ?>
		</div>
	</form>		
	<div class="clearer"></div>
</section> <!-- end editform -->

<script type="text/javascript">
// display the appropriate fields in the edit form.
	<?php  if ($doc->get('video')) { ?>
		togglePostOption('video');
	<?php  } ?>
	<?php  if ($doc->get('body')) { ?>
		togglePostOption('body');
	<?php  } ?>
	<?php  if ($doc->get('link')) { ?>
		togglePostOption('link');
	<?php  } ?>
	<?php  if ($doc->get('id') && $doc->files()->contains('file_name','img')) { ?>
		togglePostOption('photo');
	<?php  } ?>
	<?php  if ($doc->get('id') && $doc->tags()->count() > 0) { ?>
		togglePostOption('tags');
	<?php  } ?>

</script>
