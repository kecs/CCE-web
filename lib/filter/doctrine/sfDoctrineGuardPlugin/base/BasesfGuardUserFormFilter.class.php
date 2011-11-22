<?php

/**
 * sfGuardUser filter form base class.
 *
 * @package    cce
 * @subpackage filter
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'     => new sfWidgetFormFilterInput(),
      'last_name'      => new sfWidgetFormFilterInput(),
      'email_address'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'algorithm'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'           => new sfWidgetFormFilterInput(),
      'password'       => new sfWidgetFormFilterInput(),
      'is_active'      => new sfWidgetFormFilterInput(),
      'is_super_admin' => new sfWidgetFormFilterInput(),
      'last_login'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'patient_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Entity'), 'add_empty' => true)),
      'observer_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Observer'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'first_name'     => new sfValidatorPass(array('required' => false)),
      'last_name'      => new sfValidatorPass(array('required' => false)),
      'email_address'  => new sfValidatorPass(array('required' => false)),
      'username'       => new sfValidatorPass(array('required' => false)),
      'algorithm'      => new sfValidatorPass(array('required' => false)),
      'salt'           => new sfValidatorPass(array('required' => false)),
      'password'       => new sfValidatorPass(array('required' => false)),
      'is_active'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_super_admin' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_login'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'patient_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Entity'), 'column' => 'id')),
      'observer_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Observer'), 'column' => 'id')),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'first_name'     => 'Text',
      'last_name'      => 'Text',
      'email_address'  => 'Text',
      'username'       => 'Text',
      'algorithm'      => 'Text',
      'salt'           => 'Text',
      'password'       => 'Text',
      'is_active'      => 'Number',
      'is_super_admin' => 'Number',
      'last_login'     => 'Date',
      'patient_id'     => 'ForeignKey',
      'observer_id'    => 'ForeignKey',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
