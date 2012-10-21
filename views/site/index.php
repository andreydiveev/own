<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php

$this->widget('application.extensions.gallery.EGallery',
    array(
        'path' => '/images/gallery',
        'imagesPerRow'=>3,
        'name'=>'Demotivators',
        // 'other' => 'properties',
    )
);

?>