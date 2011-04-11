<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 1:25 AM
 * To change this template use File | Settings | File Templates.
 */

class Majax_Installer_Configuration_File_Tag {
  /**
   * @var string What type of question is this. True/False, Yes/No, String, etc...
   */
  private $type;

  /**
   * @var string The code in the source file to replace
   */
  private $hash;

  /**
   * @var string The description to present to the user
   */
  private $prompt;

  /**
   * @var string The default value
   */
  private $default;

  /**
   * @var bool Is this field required to be not empty
   */
  private $required;

  public function __construct($type = '', $hash = '', $prompt = '', $default = '', $required = false)
  {
    $this->type = $type;
    $this->hash = $hash;
    $this->prompt = $prompt;
    $this->default = $default;
    $this->required = $required;
  }

  public function getTypes()
  {
    return array(
      'yes/no' => 'Yes/No',
      'true/false' => 'True/False',
      'string' => 'String'
    );
  }

  public function setType($type)
  {
    if (!in_array(strtolower($type), array_keys($this->getTypes())))
    {
      throw new InvalidArgumentException($type.' is not a valid type: '.join(', ', $this->getTypes()));
    }
    $this->type = $type;
  }

  public function getType()
  {
    return $this->type;
  }

  public function setHash($hash)
  {
    $this->hash = $hash;
  }

  public function getHash()
  {
    return $this->hash;
  }

  public function setPrompt($prompt)
  {
    $this->prompt = $prompt;
  }

  public function getPrompt()
  {
    return $this->prompt;
  }

  public function setDefault($default)
  {
    $this->default = $default;
  }

  public function getDefault()
  {
    return $this->default;
  }

  public function setRequired($required)
  {
    $this->required = $required;
  }

  public function getRequired()
  {
    return $this->required;
  }
  
}
