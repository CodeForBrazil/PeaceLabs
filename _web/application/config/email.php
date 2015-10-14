<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_user'] = getenv('SENDGRID_USERNAME');
$config['smtp_pass'] = getenv('SENDGRID_PASSWORD');
$config['smtp_port'] = 587;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";

/* End of file custom.php */
/* Location: ./application/config/custom.php */
