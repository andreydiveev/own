<?php

/**
 * EGalleryManager class file.
 * 
 * Allows the management of a gallery. Can be called 
 * multiple time with different paths to manage more 
 * than one gallery.
 *
 * Useage example
 *
 * Documentation
 *
 *
 * @version 1.0
 *
 * @author scythah <scythah@gmail.com>
 * @link http://www.yiiframework.com/extension/egallery/
 */

Yii::import('application.extensions.gallery.EGalleryBase');

class EGalleryManager extends EGalleryBase {

	/**
	 * @var array the list of cache locations ('functionName'=>'cacheID')
	 */
	private $_cacheLocations = array(
								'getAlbums' => 'EGallery_%%PATH%%_albums',
								'getTitle' => 'EGallery_%%PATH%%_%%ALBUM%%_title',
								'getImages' => 'EGallery_%%PATH%%_%%ALBUM%%__images',
								'getImagesSingle' => 'EGallery_path_%%ALBUM%%_1_images',
								'getImageCount' => 'EGallery_%%PATH%%_%%ALBUM%%_numImages',
								'getDetails' => 'EGallery_%%PATH%%_%%ALBUM%%_details',
								'getDescription' => 'EGallery_%%ALBUM%%__description',
								'getDescriptionSingle' => 'EGallery_%%ALBUM%%_1_description',
							   );
	

	/**
	 * Initialisation method called by Yii when the component is loaded.
	 *
	 * Cleanup the {@see EGalleryBase::$path gallery path} and check that it's valid.
	 * Publish images and CSS.
	 */
	public function init(){
		parent::setup();

		$cs=Yii::app()->clientScript;
		$am = Yii::app()->getAssetManager();
		$this->_cssFile = $am->publish($this->generateCSS(dirname(__FILE__).DIRECTORY_SEPARATOR.'css', 'galleryManager'));
		$cs->registerCssFile($this->_cssFile);
	}

	/**
	 * Executes the widget.
	 */
	public function run()
	{
		$this->_dir = isset($_GET['dir'])?$_GET['dir']:null;

		$this->render('galleryManagerHeader', array(
						'id'=>$this->id,
						'name'=>$this->name,
						'path'=>$this->path,
						'dir'=>$this->_dir,)
				);

		$this->renderManager();

		$this->render('galleryManagerFooter');
	}

	/**
	 * Processes any actions and renders the correct view.
	 */
	protected function renderManager()
	{
		if(isset($_GET['action'])):
			switch($_GET['action']):
				case 'cache':
					/*
					 * Cache manager
					 */
					$model = new EGalleryCache;

					if(isset($_POST['EGalleryCache']))
					{
						$model->attributes=$_POST['EGalleryCache'];
						if($model->validate())
						{
							if($model->allCaches):
								/*
								 * All caches need to be cleared.
								 */
								$cachesToClear = null;
							else:
								/*
								 * Caches to clear have been specified, organise
								 * which ones need clearing.
								 */
								$cachesToClear = array();
								if($model->albums)
								{
									$cachesToClear[] = 'getAlbums';
									$cachesToClear[] = 'getTitle';
									$cachesToClear[] = 'getImagesSingle';
									$cachesToClear[] = 'getImageCount';
								}
								if($model->images)
								{
									$cachesToClear[] = 'getImages';
									$cachesToClear[] = 'getImagesSingle';
									$cachesToClear[] = 'getImageCount';
								}
								if($model->details)
								{
									$cachesToClear[] = 'getTitle';
									$cachesToClear[] = 'getDetails';
									$cachesToClear[] = 'getDescription';
									$cachesToClear[] = 'getDescriptionSingle';
								}
							endif;
							if($this->clearCaches($cachesToClear))
							{
								Yii::app()->user->setFlash('EGallerySuccess', 'The specified caches have been cleared.');

								/*
								 * Reset the $model since it has been finished with,
								 * otherwise we end up with the previously selected
								 * options still selected.
								 */
								$model = new EGalleryCache;
							}
							else
							{
								// TODO Make better error reporting (tracking) for cache clearing
								Yii::app()->user->setFlash('EGalleryError', 'Something failed when trying to clear the cache. A better error message will be provided in the future.');
							}
						}
					}

					$this->render('galleryManagerCache', array('model'=>$model));
					break;

				case 'images':
					/*
					 * Gallery manager
					 */
					if(!$this->_dir)
					{
						/*
						 * Main album list
						 */
						$this->_albums = parent::getAlbums();
						$pages=new CPagination(count($this->_albums));
						$pages->pageSize = $this->albumsPerPage;
						$this->_albums = parent::splitImages($this->_albums, $pages->pageSize);
					}
					else
					{
						/*
						 * Album selected, image list
						 */
						$this->_images = parent::getImages($this->_dir);
						$pages=new CPagination(count($this->_images));
						$pages->pageSize = $this->imagesPerPage;
						$this->_images = parent::splitImages($this->_images, $pages->pageSize);
					}

					$model = new EGalleryImages;
					$this->render('galleryManagerImages', array(
							'model'=>$model,
							'pages'=>$pages,
							'displayNumImages'=>$this->displayNumImages,
							'imagesPerRow'=>$this->imagesPerRow,
							'albumsPerRow'=>$this->albumsPerRow,
							'details'=>parent::getDetails($this->_dir),
							'albums'=>$this->_albums,
							'images'=>$this->_images,
						)
					);
					break;
				default:
					/*
					 * Undefined action
					 */
					break 2;
			endswitch;
		endif;
	}
	
	/**
	 * Clears the caches
	 *
	 * @param array $caches the list of {@see $_cacheLocations caches} to clear, null for all caches
	 * @return boolean whether the cache was cleared successfully
	 */
	protected function clearCaches($caches = null)
	{
		$result = true;
		
		$caches = (is_array($caches)) ? $caches : array_keys($this->_cacheLocations);
		
		foreach($caches as $cache)
		{
			// Check that the cache has a valid cache location
			if(array_key_exists($cache, $this->_cacheLocations))
			{
				$result = $this->clearCache($cache) && $result;
			}
		}
		
		return $result;
	}
	
	/**
	 * Clears the cache for an album.
	 *
	 * @param string $cache the cache to clear
	 * @return boolean whether the cache was cleared successfully
	 */
	protected function clearCache($cache)
	{
		$result = true;
		
		// Get a list of all albums if it hasn't been set
		$albums = (is_string($this->_dir)) ? array($this->_dir) : $this->getAlbums();
		foreach($albums as $album)
		{
			$result = $this->deleteCache($this->getCacheLocation($cache)) && $result;
		}
		return $result;
	}
	
	/**
	 * Get the cache location for the given cache and album
	 *
	 * @param string $cache the {@see $_cacheLocations}
	 * @return mixed the cache id, false on failure
	 */
	protected function getCacheLocation($cache)
	{
		if(!array_key_exists($cache, $this->_cacheLocations))
		{
			return false;
		}
		
		$location = $this->_cacheLocations[$cache];
		str_replace('%%PATH%%', $this->path, $location);
		
		if($this->_dir)
		{
			str_replace('%%ALBUM%%', $this->_dir, $location);
		}
		
		return $location;
	}
	
	/**
	 * Deletes a value from Yii's cache.
	 *
	 * @param string $id the key of the value to be deleted
	 * @return boolean whether the delete was successful
	 */
	protected function deleteCache($id)
	{
		if(!$id)
		{
			return false;
		}
		
		$_cache = (isset(Yii::app()->cache)) ? Yii::app()->cache->get($id) : false;
		if($_cache !== false)
		{
			return Yii::app()->cache->delete($id);
		}
		return false;
	}
	
	/**
	 * Gets a list of albums in the gallery
	 *
	 * @return array the albums in the gallery
	 */
	protected function getAlbums()
	{
		$albumList = array();
		$albums = new DirectoryIterator($this->_realpath);
		foreach ($albums as $album) {
			if ($album->isDir() && !$album->isDot() && substr($album->getFilename(), 0, 1) != '.') {
				$albumList[] = $album->getFilename();
			}
		}
		
		return $albumList;
	}
}