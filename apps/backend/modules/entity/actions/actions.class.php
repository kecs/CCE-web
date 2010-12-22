<?php

require_once dirname(__FILE__).'/../lib/entityGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/entityGeneratorHelper.class.php';

/**
 * entity actions.
 *
 * @package    cce
 * @subpackage entity
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class entityActions extends autoEntityActions
{
    public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->getNode()->delete())
    {
      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }

    $this->redirect('@entity');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    //can't select all records in one query, as the deletion from the tree may alter lft and rgt values
    foreach ($ids as $id)
    {
      $record = EntityTable::getInstance()->find($id);
      if ($record) //it may have been already deleted
      {
        $record->getNode()->delete();
      }
    }

    $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    $this->redirect('@entity');
  }

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->getUser()->setFlash('error', 'Automatic sorting of the tree is disabled.');
    }
    // pager is disabled
    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

  public function executeMoveAsFirstChild(sfWebRequest $request)
  {
    $entity = $this->getRoute()->getObject(); /* @var $entity Entity */
    $this->forward404Unless($parent = EntityTable::getInstance()->find($request->getParameter('parentId')));
    $entity->getNode()->moveAsFirstChildOf($parent);
    return $this->renderText('');
  }

  public function executeMoveAsPrevSibling(sfWebRequest $request)
  {
    $entity = $this->getRoute()->getObject(); /* @var $entity Entity */
    $this->forward404Unless($nextSibling = EntityTable::getInstance()->find($request->getParameter('nextSiblingId')));
    $entity->getNode()->moveAsPrevSiblingOf($nextSibling);
    return $this->renderText('');
  }

  public function executeMoveAsNextSibling(sfWebRequest $request)
  {
    $entity = $this->getRoute()->getObject(); /* @var $entity Entity */
    $this->forward404Unless($prevSibling = EntityTable::getInstance()->find($request->getParameter('prevSiblingId')));
    $entity->getNode()->moveAsNextSiblingOf($prevSibling);
    return $this->renderText('');
  }
}
