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
  const STYLE_MEDIUM = 'medium';
  
  protected $styles = array(
  	self::STYLE_MEDIUM => array('height' => 100,'width' => 100),
  );

    // Table fields
  public $id;
  
  public function __construct($data = array()) {
	$this->TABLE_NAME = self::TABLE_NAME;
    parent::__construct($data);
  }

  /**
   * Get media path
   */
  public function get_path($style = self::STYLE_ORIGINAL) {
  	if (isset($this->id)) {
  		
		$path = MEDIA_PATH.$this->id;
		
		if ($style != self::STYLE_ORIGINAL) {
			$cache_path = CACHE_PATH.$this->id.'_'.$style;
			if (file_exists($cache_path)) {
				log_message('debug','Using image cache: '.$cache_path);
				return $cache_path;
			} else {
				$style = $this->styles[$style];
				
				$config['image_library'] = 'gd2';
				$config['source_image']	= FCPATH.$path;
				$config['new_image'] = FCPATH.CACHE_PATH;
				$config['maintain_ratio'] = FALSE;
				$config['width'] =  $style['width'];
				$config['height'] = $style['height'];
				
				$this->load->library('image_lib', $config); 

				if ($this->image_lib->resize()) {
					rename(FCPATH.CACHE_PATH.$this->id,$cache_path);
					log_message('debug','Creating image cache: '.$cache_path);
					return $cache_path;
				} else {
					if (file_exists($cache_path)) unlink($cache_path);
					log_message('error','Error creating image cache: '.$this->image_lib->display_errors());
					return $path;
				}
			}
		} else {
			return $path;
		}
		
	} else return false;
  }
  
  /**
   * Insert new media
   */
  public function insert($path) {
  	if ( !file_exists($path)) return false;
	
	return (parent::insert()) && rename($path, $this->get_path());
  }
  
  /**
   * Update media
   */
  public function update($path) {
  	if ( !file_exists($path)) return false;

	return (parent::update()) && rename($path, $this->get_path());
  }
  
  /**
   * Delete media
   */
  public function delete() {
  	if (isset($this->id)) {
  		if (file_exists($this->get_path()))
		  	unlink($this->get_path());
	}
	return parent::delete();
  }
  
  
  
}

/* End of file media_model.php */
/* Location: ./application/models/media_model.php */