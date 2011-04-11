<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 3:15 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxInstaller_Input
{
  public function getResponse()
  {
    return trim(fgets(STDIN));
  }
}
