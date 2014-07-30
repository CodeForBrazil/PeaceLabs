<?php
if ( ! defined('BASEPATH'))
  exit('No direct script access allowed');

if ( ! function_exists('import_data'))
{

  /**
   * Copies all properties on $data to the given object properties.
   *
   * @param object $object 
   * @param array|object $data 
   * @return object
   */
  function import_data(&$object, $data)
  {

    // In case of $data is an object, casts it into an array.
    is_object($data) and $data = get_object_vars($data);

    if (is_array($data))
    {
      foreach ($data as $property => $value)
      {
        $property = strtolower($property);
        property_exists($object, $property) and $object->$property = $value;
      }
    }

    return $object;
  }

}

/* End of file data_helper.php */
/* Location: ./application/helpers/data_helper.php */