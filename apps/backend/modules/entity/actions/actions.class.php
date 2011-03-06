<?php

class EntityActions extends cceActions
{

  /**
   * @return EntityTable
   */
  private function getTable()
  {
    return EntityTable::getInstance();
  }

  /**
   * @return Doctrine_Tree_NestedSet
   */
  private function getTree()
  {
    return $this->getTable()->getTree();
  }

  public function executeIndexRoots(sfWebRequest $request)
  {
    $this->roots = $this->getTree()->fetchRoots();
  }

  public function executeIndex(sfWebRequest $request)
  {
    $root = $this->getRoute()->getObject(); /* @var $root Entity */
    $node = $root->getNode(); /* @var $node Doctrine_Node_NestedSet */
    $this->records = $node->getDescendants(null, true);
  }

  public function executeAddRoot(sfWebRequest $request)
  {
    $root = new Home();
    $root->save(); //create ID
    $this->getTree()->createRoot($root); //make into a root

    $this->getUser()->setFlash('notice', "'{$root}' was created.");

    $this->redirect($this->generateUrl('entity'));
  }

  public function executeAddChild(sfWebRequest $request)
  {
    $parent = $this->getRoute()->getObject(); /* @var $parent Entity */
    $type = $this->getRequestParameter('type');

    if ($type == 'Patient')
    {
      $this->getUser()->setFlash('error', "To add a Patient create the user first and then add the Patient to the user.");
      $this->redirect($this->generateUrl('user'));
    }

    $child = new $type;
    $parent->getNode()->addChild($child);

    if ($request->isXmlHttpRequest())
    {
      return $this->renderJSON($child->toArray());
    }
    else
    {
      $this->redirect($request->getReferer());
    }
  }

  public function executeMove(sfWebRequest $request)
  {
    $o = $this->getRoute()->getObject(); /* @var $o Entity */
    $this->forward404Unless($ref = $this->getTable()->find($request->getParameter('referenceId'))); /* @var $ref Entity */
    switch ($position = $request->getParameter('position'))
    {
      case 'before':
        $o->getNode()->moveAsPrevSiblingOf($ref);
        break;

      case 'inside':
        $o->getNode()->moveAsLastChildOf($ref);
        break;

      case 'after':
        $o->getNode()->moveAsNextSiblingOf($ref);
        break;

      default:
        throw new Exception("Unknown position '$position'.");
        break;
    }
    return $this->renderJSON($o->toArray());
  }

  /**
   * Recursively delete
   */
  public function executeDelete(sfWebRequest $request)
  {
    $record = $this->getRoute()->getObject(); /* @var $record Entity */

    $isRoot = $record->getNode()->isRoot();
    $record->getNode()->delete();
    $this->getUser()->setFlash('notice', "'{$record}' was deleted.");

    if ($isRoot)
    {
      $this->redirect($this->generateUrl('entity'));
    }
    else
    {
      $this->redirect($request->getReferer());
    }
  }

}
