<div id="<?php echo $id; ?>">
	<?php if(!empty($albums)): ?>
	<?php if($showNav): ?>
		<p class="gallery_nav"><?php echo $name; ?></p>
	<?php endif; ?>
	<ul class="egallery">
	<?php
	$i=1;
	foreach($albums as $album): ?>
		<li<?php if($albumsPerRow!=0 && $i%$albumsPerRow==1) echo ' class="newRow"'; ?>>
			<a href="<?php echo $this->controller->createUrl($this->controller->action->id,array('dir'=>$album['name'])); ?>" title="<?php echo $album['title']; ?>">
				<img src="<?php echo $album['thumb']; ?>" alt="<?php echo $album['title']; ?>" />
				<?php echo $album['title']; ?>
			</a>
			<?php if($displayNumImages){ printf(ngettext("%d image", "%d images", $album['count']), $album['count']); } ?>
		</li>
	<?php
		$i++;
	endforeach; ?>
	</ul>
	<div class="newRow"></div>
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

	<?php elseif(!empty($images)): ?>
	<?php if($showNav): ?>
		<p class="gallery_nav"><?php echo CHtml::link($name,
			$this->controller->createUrl($this->controller->action->id)); ?> -> <?php echo $details['name']; ?></p>
		<?php if(!empty($details['description'])): ?>
			<p class="gallery_description"><?php echo $details['description']; ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<ul class="egallery">
	<?php
	$i=1;
	foreach($images as $image): ?>
		<li<?php if($imagesPerRow!=0 && $i%$imagesPerRow==1) echo ' class="newRow"'; ?>><a href="<?php echo $image['url']; ?>" title="<?php echo $image['alt']; ?>"><img src="<?php echo $image['thumb']; ?>" alt="<?php echo $image['alt']; ?>" /><?php echo $image['alt']; ?></a></li>
	<?php
		$i++;
	endforeach; ?>
	</ul>
	<div class="newRow"></div>
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

	<?php endif; ?>
</div>