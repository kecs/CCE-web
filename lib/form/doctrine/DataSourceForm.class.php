<?php

/**
 * DataSource form.
 *
 * @package    cce
 * @subpackage form
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DataSourceForm extends BaseDataSourceForm
{

  /**
   * @see EntityForm
   */
  public function configure()
  {
    $this->useFields(array(
        'name',
        'comment',
        'parent',
        'affected_by_list',
    ));
  }

  protected function setupInheritance()
  {
    parent::setupInheritance();

    $localEntityQuery = EntityTable::getInstance()->createQuery('entity')
                    ->andWhere('entity.root_id = ?', $this->getObject()->root_id);
    $this->setWidget('affected_by_list', new sfWidgetFormDoctrineChoice(array(
                'multiple' => true,
                'model' => 'Entity',
                'query' => $localEntityQuery,
            )));
    $this->setValidator('affected_by_list', new sfValidatorDoctrineChoice(array(
                'multiple' => true,
                'model' => 'Entity',
                'required' => false,
                'query' => $localEntityQuery,
            )));
  }

}
