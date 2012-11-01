<div id="<?php echo $id; ?>">
    <div class="info">
		<p>Managing gallery: <span class="path"><?php echo $path; ?></span></p>
		<?php if($dir): ?><p>Current album: <span class="path"><?php echo $dir; ?></span></p><?php endif; ?>
	</div>
	<p>
		<?php echo CHtml::link('Manage albums', array('', 'action'=>'images')); ?> |
		<?php echo CHtml::link('Manage cache', array('', 'action'=>'cache')); ?>
	</p>