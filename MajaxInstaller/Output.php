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

  public function blankLine($count = 1)
  {
    echo str_repeat("\r\n", $count);
  }

  public function infoBlock($text, $style = STR_PAD_RIGHT)
  {
    $this->blankLine(2);

    $broken = wordwrap($text, 80, "\r\n");
    $lines = explode("\r\n", $broken);

    $max_len = 0;
    foreach($lines as $line)
    {
      $len = strlen($line);
      if ($len > $max_len)
        $max_len = $len;
    }

    $buffer_len = $max_len + 2;
    $this->line('/'.str_repeat('-', $buffer_len).'\\');
    foreach($lines as $line)
    {
      $padding = $max_len - strlen($line);
      $out = '| '.str_pad($line, $padding, ' ', STR_PAD_RIGHT).' |';
      $this->line($out);
    }
    $this->line('\\'.str_repeat('-', $buffer_len).'/');
    $this->blankLine(2);
  }
}
