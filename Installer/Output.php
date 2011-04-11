<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 2:47 AM
 * To change this template use File | Settings | File Templates.
 */
 
class Majax_Installer_Output {
  public function printLine($output)
  {
    echo $output."\r\n";
  }

  public function askAboutTag(Majax_Installer_Configuration_File_Tag $tag)
  {
    $default = '';
    if ($tag->getDefault() != '')
    {
      $default = ' (default: '.$tag->getDefault().')';
    }
    $this->printLine($tag->getPrompt().$default);
  }
}
