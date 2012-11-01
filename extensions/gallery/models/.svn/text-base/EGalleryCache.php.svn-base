<?php

class EGalleryCache extends CFormModel
{
    public $allCaches;
    public $albums;
	public $images;
	public $details;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
    {
        return array(
            array('allCaches, albums, images, details', 'boolean'),
            array('allCaches', 'atLeastOne'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'allCaches'=>'All caches',
			'albums'=>'Album list',
			'details'=>'Album titles and descriptions'
		);
	}

	/**
	 * @param string the name of the attribute to be validated
	 * @param array options specified in the validation rule
	 */
	public function atLeastOne($attribute,$params) {
			if(!$_POST['EGalleryCache']['allCaches'] && 
					!$_POST['EGalleryCache']['albums'] && 
					!$_POST['EGalleryCache']['images'] && 
					!$_POST['EGalleryCache']['details'])
			{
				$this->addError($attribute,'You must select at least one cache to clear.');
			}
	}
}