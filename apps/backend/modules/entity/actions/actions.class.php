<?php

class EntityActions extends sfActions
{

  private $model = 'Entity';

  public function executeIndex(sfWebRequest $request)
  {
    if (($this->records = $this->executeControl()))
    {
      $this->hasManyRoots = $this->modelHasManyRoots();
      $request = $this->getRequest();

      if (!$request->hasParameter('root') && !$this->modelHasManyRoots())
      {
        $this->redirect(url_for($request->getParameter('module') . '/' . $request->getParameter('action') . '?root=1'), true);
        return sfView::NONE;
      }
      elseif (!$request->hasParameter('root') && $this->modelHasManyRoots())
      {
        $this->roots = $this->getRoots($this->model);
      }
      else
      {
        $this->records = $this->getTree($this->model, $request->getParameter('root'));
      }
    }
  }

  public function executeAdd_child()
  {
    $parent_id = $this->getRequestParameter('parent_id');
    $model = $this->getRequestParameter('model');
    $field = $this->getRequestParameter('field');
    $value = $this->getRequestParameter('value');
    $record = Doctrine_Core::getTable($model)->find($parent_id);

    $child = new $model;
    $child->set($field, $value);
    $record->getNode()->addChild($child);

    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText(json_encode($child->toArray()));
  }

  public function executeAdd_root()
  {
    $type = $this->getRequestParameter('type');

    $root = new $type;
    $root->save();

    Doctrine_Core::getTable($type)->getTree()->createRoot($root);


    //return $this->redirect($this->generateUrl(strtolower($type) . '_edit', $root));
    $this->getUser()->setFlash('notice', "'{$root}' was created.");
    $this->redirect($this->generateUrl('entity'));
  }

  public function executeEdit_field()
  {
    $id = $this->getRequestParameter('id');
    $model = $this->getRequestParameter('model');
    $field = $this->getRequestParameter('field');
    $value = $this->getRequestParameter('value');

    $record = Doctrine_Core::getTable($model)->find($id);
    $record->set($field, $value);
    $record->save();

    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText(json_encode($record->toArray()));
  }

  /**
   * Recursively delete
   */
  public function executeDelete()
  {
    $record = $this->getRoute()->getObject();
    $record->getNode()->delete();

    $this->getUser()->setFlash('notice', "'{$record}' was deleted.");
    $this->redirect($this->generateUrl('entity'));
  }

  public function executeMove()
  {
    $id = $this->getRequestParameter('id');
    $to_id = $this->getRequestParameter('to_id');
    $model = $this->getRequestParameter('model');
    $movetype = $this->getRequestParameter('movetype');

    $record = Doctrine_Core::getTable($model)->find($id);
    $dest = Doctrine_Core::getTable($model)->find($to_id);

    if ($movetype == 'inside')
    {
      //$prev = $record->getNode()->getPrevSibling();
      $record->getNode()->moveAsLastChildOf($dest);
    }
    else if ($movetype == 'after')
    {
      $record->getNode()->moveAsNextSiblingOf($dest);
    }
    else if ($movetype == 'before')
    {
      //$next = $record->getNode()->getNextSibling();
      $record->getNode()->moveAsPrevSiblingOf($dest);
    }
    $this->getResponse()->setHttpHeader('Content-type', 'application/json');
    return $this->renderText($record->toArray());
  }

  /*
   * return exception if Model is not defined as NestedSet
   */

  private function executeControl()
  {
    if (!Doctrine_Core::getTable($this->model)->isTree())
    {
      throw new Exception('Model "' . $this->model . '" is not a NestedSet');
      return false;
    }
    return true;
  }

  /*
   * Returns the roots
   */

  private function getRoots($model)
  {
    $tree = Doctrine_Core::getTable($model)->getTree();
    return $tree->fetchRoots();
  }

  private function getTree($model, $rootId = null)
  {
    $tree = Doctrine_Core::getTable($model)->getTree();
    $options = array();
    if ($rootId !== null)
    {
      $options['root_id'] = $rootId;
    }
    return $tree->fetchTree($options);
  }

  private function modelIsNestedSet()
  {
    return $this->options['treeImpl'] == 'NestedSet';
  }

  private function modelHasManyRoots()
  {
    $template = Doctrine_Core::getTable($this->model)->getTemplate('NestedSet');
    $options = $template->option('treeOptions');
    return isset($options['hasManyRoots']) && $options['hasManyRoots'];
  }

}
