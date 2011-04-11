<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/10/11
 * Time: 10:11 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxInstaller {
  /**
   * @var \MajaxInstaller_Configuration
   */
  private $configuration;

  /**
   * @var \MajaxInstaller_Output
   */
  private $output;

  /**
   * @var \MajaxInstaller_Input
   */
  private $input;

  /**
   * @var \MajaxInstaller_Configuration_Tag_Helper
   */
  private $tag_helper;

  public function __construct(MajaxInstaller_Configuration $configuration = null, MajaxInstaller_Output $output = null, MajaxInstaller_Input $input = null, MajaxInstaller_Configuration_Tag_Helper $tag_helper = null)
  {
    if ($configuration !== null)
    {
      $this->configuration = $configuration;
    } else {
      $this->configuration = new MajaxInstaller_Configuration();
    }

    if ($output !== null)
    {
      $this->output = $output;
    } else {
      $this->output = new MajaxInstaller_Output();
    }

    if ($input !== null)
    {
      $this->input = $input;
    } else {
      $this->input = new MajaxInstaller_Input();
    }

    if ($tag_helper !== null)
    {
      $this->tag_helper = $tag_helper;
    } else {
      $this->tag_helper = new MajaxInstaller_Configuration_Tag_Helper($this->input, $this->output);
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
    $global_replace = array();
    if (count($this->configuration->getTags()) > 0)
    {
      $this->output->infoBlock('These answers apply to the entire installation');

      foreach ($this->configuration->getTags() as $tag)
      {
        /** @var $tag MajaxInstaller_Configuration_Tag */
        $global_replace[$tag->getHash()] = $this->tag_helper->getValue($tag);
      }
    }

    foreach ($this->configuration->getFiles() as $file)
    {
      /** @var $file MajaxInstaller_Configuration_File */

      $this->output->infoBlock('Processing '.$file->getDestination());

      $replace = array();

      foreach($file->getTags() as $tag)
      {
        /** @var $tag MajaxInstaller_Configuration_Tag */
        if (isset($global_replace[$tag->getHash()]))
        {
          $replace[$tag->getHash()] = $global_replace[$tag->getHash()];
        } else {
          $replace[$tag->getHash()] = $this->tag_helper->getValue($tag);
        }
      }

      $content = file_get_contents($file->getSource());
      $content = str_replace(array_keys($replace), array_values($replace), $content);
      file_put_contents($file->getDestination(), $content);
    }
  }

  public static function autoload()
  {
    $base_path = dirname(__FILE__);
    $loader = function($class_name) use ($base_path)
    {
      $rel_path = str_replace('_', DIRECTORY_SEPARATOR, $class_name).'.php';
      $full_path = $base_path.DIRECTORY_SEPARATOR.$rel_path;
      if (file_exists($full_path))
      {
        require_once $full_path;
      }
    };

    spl_autoload_register($loader);
  }
}
