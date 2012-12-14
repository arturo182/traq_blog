<div class="content">
	<h2 id="page_title"><?php echo l('project_settings'); ?></h2>
</div>
<?php View::render('project_settings/_nav'); ?>
<div class="content">
	<?php echo HTML::link(l('blog.new_post'), "{$project->slug}/settings/blog/new", array('class' => 'button_new', 'data-overlay' => true)); ?>
</div>
<div>
	<table class="list">
		<thead>
			<tr>
				<th class="blog_post_title"><?php echo l('blog.title'); ?></th>
				<th class="actions"><?php echo l('actions'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($posts as $post) { ?>
			<tr>
				<td><?php echo HTML::link($post->title, "{$project->slug}/settings/blog/{$post->id}/edit", array('data-overlay' => true)); ?></td>
				<td>
					<?php echo HTML::link(l('edit'), "{$project->slug}/settings/blog/{$post->id}/edit", array('class' => 'button_edit', 'data-overlay' => true)); ?>
					<?php echo HTML::link(l('delete'), "{$project->slug}/settings/blog/{$post->id}/delete", array('class' => 'button_delete', 'data-confirm' => l('confirm.delete_x', $post->title))); ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>