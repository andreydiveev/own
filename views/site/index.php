<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i>Image Mob</i></h1>

<?php

$this->widget('application.extensions.gallery.EGallery',
    array(
        'path' => '/images/gallery',
        'imagesPerRow'=>3,
        'name'=>'Image Mob',
        // 'other' => 'properties',
    )
);

?>