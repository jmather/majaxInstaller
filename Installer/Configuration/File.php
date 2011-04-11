<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 1:01 AM
 * To change this template use File | Settings | File Templates.
 */
 
class Majax_Installer_Configuration_File {
  /**
   * @var string
   */
  private $source;

  /**
   * @var string
   */
  private $destination;

  /**
   * @var array
   */
  private $tags;

  public function __construct($source = '', $destination = '', $tags = array())
  {
    $this->setSource($source);
    $this->setDestination($destination);
    $this->setTags($tags);
  }

  public function setSource($source)
  {
    $source = trim($source);
    if ($source != '' && !file_exists($source))
      throw new InvalidArgumentException($source.' does not exist!');
    $this->source = $source;
  }

  public function getSource()
  {
    return $this->source;
  }

  public function setDestination($destination)
  {
    $destination = trim($destination);
    $this->destination = $destination;
  }

  public function getDestination()
  {
    return $this->destination;
  }

  public function setTags($tags)
  {
    $this->tags = $tags;
  }

  public function getTags()
  {
    return $this->tags;
  }

  public function addTag(Majax_Installer_Configuration_File_Tag $tag)
  {
    $this->tags[] = $tag;
  }
}
