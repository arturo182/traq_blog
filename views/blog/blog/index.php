	<div class="content">
		<h2 id="page_title"><?php echo l('blog.blog'); ?></h2>
		<br>
	<?php foreach($posts as $post) { ?>
		<h2><?php echo $post->title; ?></h2>
		<i><?php echo l('blog.posted_x_by_x', time_ago($post->created_at, false), HTML::link($post->user->name, $post->user->href())); ?></i>
		<br><br>
		<?php echo format_text($post->body, true); ?>
		<hr>
	<?php } ?>
	</div>