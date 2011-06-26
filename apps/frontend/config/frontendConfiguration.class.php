<?php

class frontendConfiguration extends sfApplicationConfiguration
{

  public function configure()
  {
    
  }

  public function initialize()
  {
    parent::initialize();

    require_once dirname(__FILE__) . '/../../../lib/vendor/qCal/lib/autoload.php';
  }

}
