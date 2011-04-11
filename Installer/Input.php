<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 3:15 AM
 * To change this template use File | Settings | File Templates.
 */
 
class Majax_Installer_Input
{
  public function getResponse()
  {
    return trim(fgets(STDIN));
  }

  public function getResponseAboutTag(Majax_Installer_Configuration_File_Tag $tag)
  {
    $input = $this->getResponse();
    if ($input == '')
    {
      return $tag->getDefault();
    }
    return $input;
  }
}
