<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/10/11
 * Time: 10:11 AM
 * To change this template use File | Settings | File Templates.
 */
 
class Majax_Installer {
  /**
   * @var \Majax_Installer_Configuration
   */
  private $configuration;

  /**
   * @var \Majax_Installer_Output
   */
  private $output;

  /**
   * @var \Majax_Installer_Input
   */
  private $input;

  public function __construct(Majax_Installer_Configuration $configuration = null, Majax_Installer_Output $output = null, Majax_Installer_Input $input = null)
  {
    if ($configuration !== null)
    {
      $this->configuration = $configuration;
    } else {
      $this->configuration = new Majax_Installer_Configuration();
    }

    if ($output !== null)
    {
      $this->output = $output;
    } else {
      $this->output = new Majax_Installer_Output();
    }

    if ($input !== null)
    {
      $this->input = $input;
    } else {
      $this->input = new Majax_Installer_Input();
    }
  }

  public function loadXML($file)
  {
    $this->configuration->loadXMLFile($file);
  }

  public function loadXMLString($string)
  {
    $this->configuration->loadXMLString($string);
  }

  public function execute()
  {
    foreach ($this->configuration->getFiles() as $file)
    {
      /** @var $file Majax_Installer_Configuration_File */

      $replace = array();

      foreach($file->getTags() as $tag)
      {
        /** @var $tag Majax_Installer_Configuration_File_Tag */
        $this->output->askAboutTag($tag);
        $replace[$tag->getHash()] = $this->input->getResponseAboutTag($tag);
      }

      $content = file_get_contents($file->getSource());
      $content = str_replace(array_keys($replace), array_values($replace), $content);
      file_put_contents($file->getDestination(), $content);
    }
  }
}
