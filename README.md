# majaxInstaller

This plugin aims to provide a configurable interactive (or automated) installer system for your applications

## Sample usage:

### bin/install.php
    <?php
    require_once '/path/to/MajaxInstaller.php';
    
    MajaxInstaller::autoload();

    $installer = new MajaxInstaller();
    $installer->loadXML('/path/to/installer_config.xml');
    $installer->execute();


## Sample asset:

### assets/config.php
    <?php
    $config = array(
        'db_host' => '##HOST##',
        'db_name' => '##NAME##',
        'db_user' => '##USERNAME##',
        'db_pass' => '##PASSWORD##',
    );

## Sample configuration

### install_config.xml

    <Installer>
      <Files>
        <File source="assets/databases.yml" destination="config/databases.yml">
          <Tags>
            <Tag type="string" hash="##HOST##" prompt="Database Host" default="localhost" required="true" />
            <Tag type="string" hash="##NAME##" prompt="Database Name" default="db_name" required="true" />
            <Tag type="string" hash="##USERNAME##" prompt="Database Username" default="db_user" required="true" />
            <Tag type="string" hash="##PASSWORD##" prompt="Database Password" default="pass" required="true" />
          </Tags>
        </File>
      </Files>
    </Installer>
