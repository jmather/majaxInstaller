<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 8:53 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxInstaller_Configuration_Tag_Helper {
  /**
   * @var \MajaxInstaller_Input
   */
  private $input;

  /**
   * @var \MajaxInstaller_Output
   */
  private $output;

  public function __construct(MajaxInstaller_Input $input, MajaxInstaller_Output $output)
  {
    $this->input = $input;
    $this->output = $output;
  }

  public function getValue(MajaxInstaller_Configuration_Tag $tag)
  {
    if ($tag->getType() == 'expression')
    {
      $value = '';
      $exp = '$value = '.$tag->getDefault().';';
      eval($exp);

      $this->output->line('Setting '.$tag->getHash().' to "'.$value.'" automatically...');
      return $value;
    }

    $this->showPrompt($tag);
    return $this->getResponse($tag);
  }

  private function showPrompt($tag)
  {
    $default = '';
    if ($tag->getDefault() != '')
    {
      $default = ' (default: '.$tag->getDefault().')';
    }
    $this->output->line($tag->getPrompt().$default);
    $this->output->prompt('Answer');
  }

  private function getResponse($tag)
  {
    $input = $this->input->getResponse();
    if ($input == '')
    {
      return $tag->getDefault();
    }
    return $input;
  }
}
