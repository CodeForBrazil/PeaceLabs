<?php
if ( ! defined('BASEPATH'))
  exit('No direct script access allowed');

if ( ! function_exists('admin_report'))
{

  /**
   * Send email to admin
   */
  function admin_report($title,$content) {
	$ci = get_instance();
	$ci->load->library('email');
	
	$ci->email->from(SENDER_EMAIL);
	$ci->email->to(ADMIN_EMAIL);
	$ci->email->subject($title);
	$ci->email->message($content);
	
	log_message('warning',"$title: $content");	
	
	$ci->email->send();
   	
  }

}


if ( ! function_exists('email_user_confirmation'))
{

  /**
   * Send email to admin
   */
  function email_user_confirmation($user) {
	$ci = get_instance();
	$ci->load->library('email');
	
	$ci->email->from(SENDER_EMAIL);
	$ci->email->to($user->email);
	$ci->email->subject(lang('email_user_confirmation_title'));
	$url = site_url('user/confirmation/'.$user->confirmation);
	$ci->email->message(sprintf(lang('email_user_confirmation_content'),$url));
	
	log_message('info',"User confirmation for: ".$user->email);	
	
	$ci->email->send();
   	
  }

}