# majaxInstaller

This plugin aims to provide a configurable interactive (or automated) installer system for your applications

## Sample usage:

### bin/install.php
    <?php
    require_once '../MajaxInstaller/MajaxInstaller.php';

    MajaxInstaller::autoload();

    $installer = new MajaxInstaller();
    $installer->loadXML('installer_config.xml');
    $installer->execute();


## Sample asset:

### assets/config.php
    <?php
    $config = array(
        'db_host' => '##HOST##',
        'db_name' => '##NAME##',
        'db_user' => '##USERNAME##',
        'db_pass' => '##PASSWORD##',
        'csrf_secret' => '##CSRF_TOKEN##',
        'cross_talk_secret' => '##CROSS_TALK_TOKEN##',
    );

## Sample configuration

### install_config.xml

    <Installer>
      <Tags>
        <Tag type="string" hash="##HOST##" prompt="Database Host" default="localhost" required="true" />
        <Tag type="string" hash="##USERNAME##" prompt="Database Username" default="db_user" required="true" />
        <Tag type="string" hash="##PASSWORD##" prompt="Database Password" default="pass" required="true" />
        <Tag type="expression" hash="##CROSS_TALK_TOKEN##" default="md5(time().rand())" />
      </Tags>
      <Files>
        <File source="assets/config.php" destination="site1/includes/config.php">
          <Tags>
            <Tag type="string" hash="##HOST##" prompt="Database Host" default="localhost" required="true" />
            <Tag type="string" hash="##USERNAME##" prompt="Database Username" default="db_user" required="true" />
            <Tag type="string" hash="##PASSWORD##" prompt="Database Password" default="pass" required="true" />
            <Tag type="string" hash="##NAME##" prompt="Database Name" default="db1_name" required="true" />
            <Tag type="expression" hash="##CSRF_TOKEN##" default="md5(time().rand())" />
            <Tag type="expression" hash="##CROSS_TALK_TOKEN##" default="md5(time().rand())" />
          </Tags>
        </File>
        <File source="assets/config.php" destination="site2/includes/config.php">
          <Tags>
            <Tag type="string" hash="##HOST##" prompt="Database Host" default="localhost" required="true" />
            <Tag type="string" hash="##USERNAME##" prompt="Database Username" default="db_user" required="true" />
            <Tag type="string" hash="##PASSWORD##" prompt="Database Password" default="pass" required="true" />
            <Tag type="string" hash="##NAME##" prompt="Database Name" default="db2_name" required="true" />
            <Tag type="expression" hash="##CSRF_TOKEN##" default="md5(time().rand())" />
            <Tag type="expression" hash="##CROSS_TALK_TOKEN##" default="md5(time().rand())" />
          </Tags>
        </File>
      </Files>
    </Installer>


## Sample output

### To the console

    $ ./bin/install.php


    /------------------------------------------------\
    | These answers apply to the entire installation |
    \------------------------------------------------/


    Database Host (default: localhost)
    Answer:
    Database Username (default: db_user)
    Answer:
    Database Password (default: pass)
    Answer:
    Setting ##CROSS_TALK_TOKEN## to "c7413c512b0fd29eed307fce3179a352" automatically...


    /--------------------------------------\
    | Processing site1/includes/config.php |
    \--------------------------------------/


    Database Name (default: db_name)
    Answer:
    Setting ##CSRF_TOKEN## to "455d6ad4a86405f862fcbd05e1e2637e" automatically...


    /--------------------------------------\
    | Processing site2/includes/config.php |
    \--------------------------------------/


    Database Name (default: db_name)
    Answer:
    Setting ##CSRF_TOKEN## to "1473c3ce8a4b5ddb0b72ab3666495ffc" automatically...

### site1/includes/config.php

    <?php
    $config = array(
        'db_host' => 'localhost',
        'db_name' => 'db_name',
        'db_user' => 'db_user',
        'db_pass' => 'pass',
        'csrf_secret' => '655bffd78a1076fd4448d71ed565d8f8',
        'cross_talk_secret' => '18e06e11ddfa9b17b42a864a6dfdd6e3',
    );

### site2/includes/config.php

    <?php
    $config = array(
        'db_host' => 'localhost',
        'db_name' => 'db_name',
        'db_user' => 'db_user',
        'db_pass' => 'pass',
        'csrf_secret' => '1ea1ab551cdc659ea0c9ebef3050d5d7',
        'cross_talk_secret' => '18e06e11ddfa9b17b42a864a6dfdd6e3',
    );
