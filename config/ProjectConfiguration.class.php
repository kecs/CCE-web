<?php

require_once dirname(__FILE__) . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{

  public function setup()
  {
    $this->enablePlugins(array(
        'sfDoctrinePlugin',
        'sfAutoconfigPlugin',
        'emtActivityPlugin',
        'emtEKGPlugin',
        'doAuthPlugin',
    ));


    $this->getEventDispatcher()->connect(
            'request.method_not_found', array('sfRequestExtension', 'listenToMethodNotFound')
    );
  }

}

class sfRequestExtension
{

  static public function listenToMethodNotFound(sfEvent $event)
  {
    /**
     * Method getRawBody
     * retrieve raw post data
     */
    if ($event['method'] == 'getRawBody')
    {
      $event->setProcessed(true);
      $request = $event->getSubject();
      $environment = sfContext::getInstance()->getConfiguration()->getEnvironment();
      $request_body = $environment == 'test' ? $request->getParameter('body') : file_get_contents('php://input');
      $event->setReturnValue($request_body);
    }
  }

}