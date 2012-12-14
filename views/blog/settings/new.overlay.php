<h3><?php echo l('blog.new_post'); ?></h3>
<form action="<?php echo Request::requestUri(); ?>" method="post" class="overlay_thin">
	<?php show_errors($post->errors); ?>
	<div class="tabular">
		<?php View::render('blog/settings/_form'); ?>
	</div>
	<div class="actions">
		<input type="submit" value="<?php echo l('create'); ?>" />
		<input type="button" value="<?php echo l('cancel'); ?>" onclick="close_overlay();" />
	</div>
</form>