<?php

/**
 * Entity form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EntityForm extends BaseEntityForm
{

  public function configure()
  {
    $this->useFields(array('name', 'comment', 'parent'));
  }

  protected function setupInheritance()
  {
    parent::setupInheritance();

    // create a new widget to represent this category's "parent"
    $this->setWidget('parent', new sfWidgetFormDoctrineChoiceNestedSet(array(
                'model' => 'Entity',
                'add_empty' => true,
            )));

    // set a validator for parent which prevents a category being moved to one of its own descendants
    $this->setValidator('parent', new sfValidatorDoctrineChoiceNestedSet(array(
                'required' => false,
                'model' => 'Entity',
                'node' => $this->getObject(),
            )));
    $this->getValidator('parent')->setMessage('node', 'A category cannot be made a descendent of itself.');


    // if the current category has a parent, make it the default choice
    if ($this->getObject()->getNode()->hasParent())
    {
      $this->setDefault('parent', $this->getObject()->getNode()->getParent()->getId());
    }

    $localLocalityQuery = LocalityTable::getInstance()->createQuery('locality')
                    ->andWhere('locality.root_id = ?', $this->getObject()->root_id);
    $this->setWidget('locality_id', new sfWidgetFormDoctrineChoice(array(
                'model' => 'Locality',
                'add_empty' => true,
                'query' => $localLocalityQuery
            )));
    $this->setWidget('locality2_id', clone $this->getWidget('locality_id'));
    $this->setValidator('locality_id', new sfValidatorDoctrineChoice(array(
                'model' => 'Locality',
                'required' => false,
                'query' => $localLocalityQuery
            )));
    $this->setValidator('locality2_id', clone $this->getValidator('locality_id'));
  }

  /**
   * Updates and saves the current object. Overrides the parent method
   * by treating the record as a node in the nested set and updating
   * the tree accordingly.
   *
   * @param Doctrine_Connection $con An optional connection parameter
   */
  protected function doSave($con = null)
  {
    // save the record itself
    parent::doSave($con);

    //if parent has changed
    // if a parent has been specified, add/move this node to be the child of that node
    if ($this->getValue('parent'))
    {
      $parent = EntityTable::getInstance()->findOneById($this->getValue('parent'));
      if ($this->isNew())
      {
        $this->getObject()->getNode()->insertAsLastChildOf($parent);
      }
      else
      {
        if ($parent != $this->getObject()->getNode()->getParent()) //skip move if the node it at the right place
        {
          $this->getObject()->getNode()->moveAsLastChildOf($parent);
        }
      }
    }
    // if no parent was selected, add/move this node to be a new root in the tree
    else
    {
      $entityTree = EntityTable::getInstance()->getTree();
      if ($this->isNew())
      {
        $entityTree->createRoot($this->getObject());
      }
      else
      {
        if (!$this->getObject()->getNode()->isRoot())
        {
          $this->getObject()->getNode()->makeRoot($this->getObject()->getId());
        }
      }
    }
  }

}
