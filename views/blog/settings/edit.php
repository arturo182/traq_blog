<div class="content">
	<h2 id="page_title"><?php echo l('project_settings'); ?></h2>
</div>
<?php View::render('project_settings/_nav'); ?>
<div class="content">
	<h3><?php echo l('blog.edit_post'); ?></h3>
	<form action="<?php echo Request::requestUri(); ?>" method="post">
		<?php show_errors($post->errors); ?>
		<div class="tabular box">
			<?php View::render('blog/settings/_form'); ?>
		</div>
		<div class="actions">
			<input type="submit" value="<?php echo l('save'); ?>" />
		</div>
	</form>
</div>