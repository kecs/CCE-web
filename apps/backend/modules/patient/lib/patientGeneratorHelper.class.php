<?php

/**
 * patient module helper.
 *
 * @package    cce
 * @subpackage patient
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class patientGeneratorHelper extends BasePatientGeneratorHelper
{

  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'user' : parent::getUrlForAction($action);
  }

  public function linkToTree($entity, $params) /* @var $entity Entity */
  {
    if ($entity->getTreeRoot())
    {
      return '<li class="sf_admin_action_list">' . link_to(__($params['label'], array(), 'sf_admin'), 'entity_index', $entity->getTreeRoot()) . '</li>';
    }
  }

}
