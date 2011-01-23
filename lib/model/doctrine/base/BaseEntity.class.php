<?php

/**
 * BaseEntity
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property clob $comment
 * @property string $type
 * @property integer $social_security_number
 * @property string $born_at
 * @property string $address
 * @property integer $locality_type_id
 * @property integer $locality_id
 * @property integer $locality2_id
 * @property sfGuardUser $sfGuardUser
 * @property Doctrine_Collection $Observers
 * @property Doctrine_Collection $Observation
 * @property Doctrine_Collection $Measurement
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method string              getName()                   Returns the current record's "name" value
 * @method clob                getComment()                Returns the current record's "comment" value
 * @method string              getType()                   Returns the current record's "type" value
 * @method integer             getSocialSecurityNumber()   Returns the current record's "social_security_number" value
 * @method string              getBornAt()                 Returns the current record's "born_at" value
 * @method string              getAddress()                Returns the current record's "address" value
 * @method integer             getLocalityTypeId()         Returns the current record's "locality_type_id" value
 * @method integer             getLocalityId()             Returns the current record's "locality_id" value
 * @method integer             getLocality2Id()            Returns the current record's "locality2_id" value
 * @method sfGuardUser         getSfGuardUser()            Returns the current record's "sfGuardUser" value
 * @method Doctrine_Collection getObservers()              Returns the current record's "Observers" collection
 * @method Doctrine_Collection getObservation()            Returns the current record's "Observation" collection
 * @method Doctrine_Collection getMeasurement()            Returns the current record's "Measurement" collection
 * @method Entity              setId()                     Sets the current record's "id" value
 * @method Entity              setName()                   Sets the current record's "name" value
 * @method Entity              setComment()                Sets the current record's "comment" value
 * @method Entity              setType()                   Sets the current record's "type" value
 * @method Entity              setSocialSecurityNumber()   Sets the current record's "social_security_number" value
 * @method Entity              setBornAt()                 Sets the current record's "born_at" value
 * @method Entity              setAddress()                Sets the current record's "address" value
 * @method Entity              setLocalityTypeId()         Sets the current record's "locality_type_id" value
 * @method Entity              setLocalityId()             Sets the current record's "locality_id" value
 * @method Entity              setLocality2Id()            Sets the current record's "locality2_id" value
 * @method Entity              setSfGuardUser()            Sets the current record's "sfGuardUser" value
 * @method Entity              setObservers()              Sets the current record's "Observers" collection
 * @method Entity              setObservation()            Sets the current record's "Observation" collection
 * @method Entity              setMeasurement()            Sets the current record's "Measurement" collection
 * 
 * @package    cce
 * @subpackage model
 * @author     Adam Banko (Cassus)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseEntity extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('entity');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('comment', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('social_security_number', 'integer', null, array(
             'type' => 'integer',
             'comment' => 'taj szam',
             ));
        $this->hasColumn('born_at', 'string', 255, array(
             'type' => 'string',
             'comment' => 'szuletesi hely, idopont',
             'length' => 255,
             ));
        $this->hasColumn('address', 'string', 255, array(
             'type' => 'string',
             'comment' => 'lakcim',
             'length' => 255,
             ));
        $this->hasColumn('locality_type_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('locality_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('locality2_id', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->setSubClasses(array(
             'Patient' => 
             array(
              'type' => 'Patient',
             ),
             'Home' => 
             array(
              'type' => 'Home',
             ),
             'Locality' => 
             array(
              'type' => 'Locality',
             ),
             'Window' => 
             array(
              'type' => 'Window',
             ),
             'Door' => 
             array(
              'type' => 'Door',
             ),
             'DataSource' => 
             array(
              'type' => 'DataSource',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser', array(
             'local' => 'id',
             'foreign' => 'id'));

        $this->hasMany('Observer as Observers', array(
             'refClass' => 'Observation',
             'local' => 'entity_id',
             'foreign' => 'observer_id'));

        $this->hasMany('Observation', array(
             'local' => 'id',
             'foreign' => 'entity_id'));

        $this->hasMany('Measurement', array(
             'local' => 'id',
             'foreign' => 'entity_id'));

        $nestedset0 = new Doctrine_Template_NestedSet(array(
             'hasManyRoots' => true,
             'rootColumnName' => 'root_id',
             ));
        $this->actAs($nestedset0);
    }
}