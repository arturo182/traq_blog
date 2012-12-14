<div class="group">
	<label><?php echo l('blog.title'); ?></label>
	<?php echo Form::text('title', array('value' => $post->title)); ?>
</div>
<div class="group">
	<label><?php echo l('blog.content'); ?></label>
	<?php echo Form::textarea('body', array('value' => $post->body, 'class' => 'editor')); ?>
</div>