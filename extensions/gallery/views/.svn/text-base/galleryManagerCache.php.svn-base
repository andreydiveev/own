<h2>Clear EGallery caches.</h2>
<div>
	<p>
		<strong>Please note:</strong> You only need to use this section if you
		have modified files outside of this management section (eg. added photos via FTP).
	</p>
</div>

<?php
$hasFlash = (Yii::app()->user->hasFlash('EGallerySuccess'))?true:false;
if($hasFlash): ?>
<div class="info success">
	<?php echo Yii::app()->user->getFlash('EGallerySuccess'); ?>
</div>
<?php endif; ?>
<?php
$hasFlash = (Yii::app()->user->hasFlash('EGalleryError'))?true:false;
if($hasFlash): ?>
<div class="info error">
	<?php echo Yii::app()->user->getFlash('EGalleryError'); ?>
</div>
<?php endif; ?>

<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::errorSummary($model); ?>

<fieldset>
	<legend>Choose which caches you wish to clear</legend>
	<div class="row">
		<?php echo CHtml::activeCheckBox($model, 'allCaches'); ?>
		<?php echo CHtml::activeLabel($model, 'allCaches'); ?>
		<div class="hint">If selected, this option will override any other option.</div>
	</div>
</fieldset>

<fieldset>
	<legend>Or select the individual caches to clear</legend>
	<div class="row">
		<?php echo CHtml::activeCheckBox($model, 'albums'); ?>
		<?php echo CHtml::activeLabel($model, 'albums'); ?>
		<div class="hint">If you have uploaded a new album, or deleted an existing
			one via <acronym title="File Transfer Protocol">FTP</acronym>.</div>
	</div>
	<div class="row">
		<?php echo CHtml::activeCheckBox($model, 'images'); ?>
		<?php echo CHtml::activeLabel($model, 'images'); ?>
		<div class="hint">If you have uploaded or deleted images from an existing
			album via <acronym title="File Transfer Protocol">FTP</acronym>.</div>
	</div>
	<div class="row">
		<?php echo CHtml::activeCheckBox($model, 'details'); ?>
		<?php echo CHtml::activeLabel($model, 'details'); ?>
		<div class="hint">If you have edited the <code>description.txt</code>
			file for an existing album via <acronym title="File Transfer Protocol">FTP</acronym>.</div>
	</div>
</fieldset>

<fieldset>
	<div class="row buttons">
		<input name="submit" type="submit" value="Submit" />
	</div>
</fieldset>
<?php echo CHtml::endForm(); ?>