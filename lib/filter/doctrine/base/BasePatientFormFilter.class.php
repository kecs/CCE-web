<?php

/**
 * Patient filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePatientFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'social_security_number' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'born_at'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'social_security_number' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'born_at'                => new sfValidatorPass(array('required' => false)),
      'address'                => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('patient_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Patient';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'user_id'                => 'ForeignKey',
      'social_security_number' => 'Number',
      'born_at'                => 'Text',
      'address'                => 'Text',
    );
  }
}
