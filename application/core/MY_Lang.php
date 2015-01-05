<?php 
if ( ! defined('BASEPATH'))
  exit('No direct script access allowed');

class MY_Lang extends CI_Lang
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function switch_lang($idiom)
    {
        $CI =& get_instance();
        if(is_string($idiom) && $idiom != $CI->config->item('language'))
        {
            $CI->config->set_item('language',$idiom);
            $loaded = $this->is_loaded;
            $this->is_loaded = array();
                
            foreach($loaded as $file)
            {
                $this->load(str_replace('_lang.php','',$file));    
            }
        }
    }
    
} 