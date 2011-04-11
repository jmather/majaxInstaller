<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/10/11
 * Time: 11:11 AM
 * To change this template use File | Settings | File Templates.
 */

class Majax_Installer_Configuration
{
  private $files;

  public function __construct()
  {
    $this->configuration = array();
  }

  public function loadXMLFile($file)
  {
    $contents = file_get_contents($file);
    $this->loadXMLString($contents);
  }

  public function loadXMLString($string)
  {
    $xmlObj = simplexml_load_string($string);
    $xml_array = $this->xmlObjectToArray($xmlObj);
    $this->xmlArrayToConfiguration($xml_array);
  }

  /**
   * Converts XML to an Array
   * Based on a function by svdmeer at xs4all dot nl -- http://php.net/manual/en/book.simplexml.php
   * @param string $xml
   * @return array
   */
  private function xmlObjectToArray($xml) {
    $arXML=array();
    $arXML['name']=trim($xml->getName());
    $arXML['value']=trim((string)$xml);
    $t=array();
    foreach($xml->attributes() as $name => $value){
        $t[$name]=trim($value);
    }
    $arXML['attributes']=$t;
    $t=array();
    foreach($xml->children() as $name => $xmlchild) {
        $t[]=$this->xmlObjectToArray($xmlchild); //FIX : For multivalued node
    }
    $arXML['children']=$t;
    return $arXML;
  }

  protected function getDefaultTagArray()
  {
    $tag_defaults = array(
      'type' => 'string',
      'hash' => '',
      'prompt' => '',
      'default' => '',
      'required' => false
    );
    return $tag_defaults;
  }

  protected function xmlArrayToConfiguration($xmlArray)
  {
    if ($xmlArray['name'] != 'Installer')
    {
      throw new InvalidArgumentException('XML Configuration is invalid. Installer is not the root element.');
    }
    foreach($xmlArray['children'] as $node)
    {
      $tag_defaults = $this->getDefaultTagArray();

      if ($node['name'] == 'Files')
      {
        foreach($node['children'] as $files_node)
        {
          if ($files_node['name'] == 'File')
          {
            $f = new Majax_Installer_Configuration_File();
            $f->setSource($files_node['attributes']['source']);
            $f->setDestination($files_node['attributes']['destination']);
            foreach($files_node['children'] as $node2)
            {
              if ($node2['name'] == 'Tags')
              {
                foreach($node2['children'] as $tags_node)
                {
                  if ($tags_node['name'] == 'Tag')
                  {
                    $t = new Majax_Installer_Configuration_File_Tag();
                    $a = array_merge($tag_defaults, $tags_node['attributes']);
                    $t->setType($a['type']);
                    $t->setHash($a['hash']);
                    $t->setPrompt($a['prompt']);
                    $t->setDefault($a['default']);
                    if ($a['required'] == 'true')
                      $t->setRequired(true);
                    else
                      $t->setRequired(false);
                    $f->addTag($t);
                  }
                }
              }
            }
            $this->files[] = $f;
          }
        }
      }
    }
  }

  public function getFiles()
  {
    return $this->files;
  }
}
