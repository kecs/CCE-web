<?php

/**
 * fridgeBackend module helper.
 *
 * @package    cce
 * @subpackage fridgeBackend
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fridgeBackendGeneratorHelper extends BaseFridgeBackendGeneratorHelper
{

  public function linkToTree($entity, $params) /* @var $entity Entity */
  {
    return '<li class="sf_admin_action_list">' . link_to(__($params['label'], array(), 'sf_admin'), 'entity_index', $entity->getTreeRoot()) . '</li>';
  }

}
