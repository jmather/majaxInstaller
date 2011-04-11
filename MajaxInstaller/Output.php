<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/11/11
 * Time: 2:47 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxInstaller_Output {
  public function line($output, $new_line = true)
  {
    echo $output;
    if ($new_line)
      echo "\r\n";
  }

  public function prompt($output)
  {
    $this->line($output.': ', false);
  }
}
