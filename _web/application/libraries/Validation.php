<?php
if ( ! defined('BASEPATH')) 
  exit('No direct script access allowed');

/**
 * Validation class.
 */
class Validation
{

  /**
   * Checks if given user is authenticated (has signed in).
   *
   * @param User_model $user
   * @param int $type 
   * @param boolean $redirect 
   * @return boolean
   */
  public function check_user($user, $type = null, $redirect = true)
  {
    $check = ! empty($user);
    if ( ! $check and $redirect)
    {
      redirect('/?from='.urlencode(current_url()));
    }
    if ($check)
    {
      if (!is_null($type) and !$user->is($type))
      {
        $check = false;
        $redirect and redirect('/');
      }
    }
    return $check;
  }

  /**
   * Gets validation messages (from form validation).
   *
   * @return array|null
   */
  public function get_messages()
  {
    if ( ! function_exists('validation_errors'))
    {
      return null;
    }
    $messages = explode(',', validation_errors(' ', ','));
    foreach ($messages as $i => $m)
    {
      $messages[$i] = trim($m);
    }
    return array_filter($messages);
  }

}

/* End of file Validation.php */
/* Location: ./application/library/Validation.php */