<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('UPLOAD_PATH', 'upload/');

$config['sender_email'] = 'hhlets@gmail.com';
$config['contact_email'] = 'hhlets@gmail.com';
$config['admin_email'] = 'thierry@thde.pro';
$config['encode_code_word'] = 'azerty123456';
$config['default_avatar'] = '/assets/img/avatar.png';
$config['default_avatar_fake'] = '/assets/img/avatar_fake.png';
$config['default_image'] = '/assets/img/image.png';

$config['available_languages'] = array('fr' => 'french','pt' => 'portugues-br'); //, 'en' => 'english');
$config['available_locales'] = array('fr' => 'fr_FR','pt' => 'pt_BR'); //, 'en' => 'en_US');
$config['locale'] = 'pt_BR';

/*
$config['root_path'] = APPPATH.'../';
$config['upload_path'] = 'upload/';
$config['media_path'] = UPLOAD_PATH.'medias/';
$config['cache_path'] = UPLOAD_PATH.'cache/';
$config['cache_media'] = TRUE;
*/

/* old custom.php file
define('SENDER_EMAIL', 'hhlets@gmail.com');
define('CONTACT_EMAIL', 'hhlets@gmail.com');
define('ADMIN_EMAIL', 'thierry@thde.pro');
define('ENCODE_CODE_WORD', 'azerty123456');
define('ROOT_PATH',APPPATH.'../');
define('UPLOAD_PATH', 'upload/');
define('MEDIA_PATH', UPLOAD_PATH.'medias/');
define('CACHE_PATH', UPLOAD_PATH.'cache/');
define('DEFAULT_AVATAR', '/assets/img/avatar.png');
define('DEFAULT_AVATAR_FAKE', '/assets/img/avatar_fake.png');
define('DEFAULT_IMAGE', '/assets/img/image.png');
define('CACHE_MEDIA', TRUE);
*/

/* End of file custom.php */
/* Location: ./application/config/custom.php */