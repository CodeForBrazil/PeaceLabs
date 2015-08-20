<?php
if ( ! defined('BASEPATH')) 
  exit('No direct script access allowed');

/**
 * Media model.
 */
class Media_model extends MY_Model
{

  /**
   * Table name.
   */
  const TABLE_NAME = 'media';
  
  const STYLE_ORIGINAL = NULL;
//  const STYLE_ROOT = 'root';
  const STYLE_SMALL = 'small';
  const STYLE_MEDIUM = 'medium';
  const STYLE_LARGE = 'large';
  
  protected $styles = array(
  	self::STYLE_SMALL => array('height' => 20,'width' => 20, "crop" => "fill"),
  	self::STYLE_MEDIUM => array('height' => 100,'width' => 100, "crop" => "fill"),
  	self::STYLE_LARGE => array('height' => 200,'width' => 200, "crop" => "fill"),
  	self::STYLE_ORIGINAL => array(),
  );

    // Table fields
  public $id;
  public $public_id;
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
  }

  /**
   * Get media path
   */
  public function get_path($style = self::STYLE_ORIGINAL) {
//  	if ($this->public_id && $style != self::STYLE_ROOT) {
  		return cloudinary_url($this->public_id, $this->styles[$style]);
//  	}
	/*
  	if (isset($this->id)) {
  		
		$path = MEDIA_PATH.$this->id;
		
		if (!in_array($style,array(self::STYLE_ORIGINAL,self::STYLE_ROOT))) {
			$cache_path = CACHE_PATH.$this->id.'_'.$style;
			if ($this->config->item('cache_media') && file_exists(ROOT_PATH.$cache_path)) {
				log_message('debug','Using image cache: '.$cache_path);
				$path = $cache_path;
			} else {
				$style = $this->styles[$style];
				
				$config['image_library'] = 'gd2';
				$config['source_image']	= ROOT_PATH.$path;
				$config['new_image'] = ROOT_PATH.CACHE_PATH;
				$config['maintain_ratio'] = FALSE;
				$config['width'] =  $style['width'];
				$config['height'] = $style['height'];
				
				$this->load->library('image_lib', $config); 

				if ($this->image_lib->resize()) {
					rename(ROOT_PATH.CACHE_PATH.$this->id,$cache_path);
					log_message('debug','Creating image cache: '.$cache_path);
					$path = $cache_path;
				} else {
					if (file_exists(ROOT_PATH.$cache_path)) unlink($cache_path);
					log_message('error','Error creating image cache: '.$this->image_lib->display_errors());
				}
			}
		}
		if ($style == self::STYLE_ROOT) return ROOT_PATH.$path;
		else return site_url($path);
		
	} else return false;*/
  }
  
  /**
   * Insert new media
   */
  public function insert($path) {
  	if ( !file_exists($path)) return false;
	
	$res = \Cloudinary\Uploader::upload($path);	
	$this->public_id = $res['public_id'];

	return parent::insert();
  }
  
  /**
   * Update media
   */
  public function update($path) {
  	if ( !file_exists($path)) return false;

	if ($this->public_id)  \Cloudinary\Uploader::destroy($this->public_id);
	
	$res = \Cloudinary\Uploader::upload($path);	
	$this->public_id = $res['public_id'];

	return parent::update();
  }
  
  /**
   * Delete media
   */
  public function delete() {
/*  	if (isset($this->id)) {
  		if (file_exists($this->get_path(self::STYLE_ROOT)))
		  	unlink($this->get_path(self::STYLE_ROOT));
	}*/
	if ($this->public_id)  \Cloudinary\Uploader::destroy($this->public_id);

	return parent::delete();
  }
  
  
  
}

/* End of file media_model.php */
/* Location: ./application/models/media_model.php */