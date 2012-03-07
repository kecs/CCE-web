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
  public function configure(){
    $this->useFields(array(
        'name',
        'comment',
        'channel',
        'parent',
        'affected_by_list',
    ));
    
    
    $channels = $this -> getObject() -> getActiveChannels();
    if(! count($channels)){
        $channels = MeasurementTable :: getInstance() -> getChannels();
    }
    
    $choices = array();
    foreach($channels as $channel){
        $choices[$channel] = $channel;
    }

    $this -> widgetSchema['channel'] = new sfWidgetFormSelect(
        array('choices' => $choices)
        
        //array('selected' => 3)
    );
    
    $this -> validatorSchema['channel'] = new sfValidatorChoice(
        array('choices' => $channels)
    );
    
    //$this -> setDefaults(array('choices' => 555));
    //$this -> setDefaults(array('channel' => 555));
    //$this->setDefaults(array('choices' => 2));

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
