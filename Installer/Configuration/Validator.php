<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/10/11
 * Time: 12:22 PM
 * To change this template use File | Settings | File Templates.
 */
 
class Majax_Installer_Configuration_Validator {
  public function validate($configuration)
  {
    return true;
    $this->hasRequiredKeys($configuration, array('Files'), 'Configuration Root');
    $this->hasChildren($configuration, array('Files'), 'Configuration Root');
    $this->validateFiles($configuration);
  }

  protected function hasRequiredKeys($configuration, $keys, $parent_element)
  {
    foreach($keys as $name)
    {
      if (!isset($configuration[$name]))
        throw new InvalidArgumentException('No "'.$name.'" parameter within "'.$parent_element.'"');
    }
  }

  protected function hasChildren($configuration, $keys, $parent_element)
  {
    foreach($keys as $name)
    {
      if (count($configuration[$name]) == 0)
        throw new InvalidArgumentException('"'.$name.'" within "'.$parent_element.'" is empty.');
    }
  }

  protected function hasOnlyKeys($configuration, $keys, $parent_element)
  {
    foreach($configuration as $name => $data)
    {
      if (!in_array($name, $keys))
        throw new InvalidArgumentException('"'.$name.'" is not allowed within "'.$parent_element.'"');
    }
  }

  private function validateFiles($configuration)
  {
    $this->hasOnlyKeys($configuration, array('File'), 'Configuration Root > Files');

    foreach($configuration['Files'] as $name => $data)
    {
      if ($name == 'File')
      {
        $this->validateFile($data);
      }
    }

  }

  private function validateFile($configuration)
  {
    
  }
}
