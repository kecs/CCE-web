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
 * @property string $channel
 * @property float $error_lower_limit
 * @property float $warning_lower_limit
 * @property float $warning_upper_limit
 * @property float $error_upper_limit
 * @property integer $social_security_number
 * @property string $born_at
 * @property string $address
 * @property string $calendar_url
 * @property integer $locality_type_id
 * @property integer $locality_id
 * @property integer $locality2_id
 * @property LocalityType $LocalityType
 * @property Entity $Locality1
 * @property Entity $Locality2
 * @property EntityType $EntityType
 * @property sfGuardUser $sfGuardUser
 * @property Doctrine_Collection $Observers
 * @property Doctrine_Collection $Observation
 * @property Doctrine_Collection $Entity
 * @property Doctrine_Collection $Door
 * @property Doctrine_Collection $AffectedDataSources
 * @property Doctrine_Collection $DataSourceAffected
 * @property Doctrine_Collection $Sensor
 * @property Doctrine_Collection $Measurement
 * 
 * @method integer             getId()                     Returns the current record's "id" value
 * @method string              getName()                   Returns the current record's "name" value
 * @method clob                getComment()                Returns the current record's "comment" value
 * @method string              getType()                   Returns the current record's "type" value
 * @method string              getChannel()                Returns the current record's "channel" value
 * @method float               getErrorLowerLimit()        Returns the current record's "error_lower_limit" value
 * @method float               getWarningLowerLimit()      Returns the current record's "warning_lower_limit" value
 * @method float               getWarningUpperLimit()      Returns the current record's "warning_upper_limit" value
 * @method float               getErrorUpperLimit()        Returns the current record's "error_upper_limit" value
 * @method integer             getSocialSecurityNumber()   Returns the current record's "social_security_number" value
 * @method string              getBornAt()                 Returns the current record's "born_at" value
 * @method string              getAddress()                Returns the current record's "address" value
 * @method string              getCalendarUrl()            Returns the current record's "calendar_url" value
 * @method integer             getLocalityTypeId()         Returns the current record's "locality_type_id" value
 * @method integer             getLocalityId()             Returns the current record's "locality_id" value
 * @method integer             getLocality2Id()            Returns the current record's "locality2_id" value
 * @method LocalityType        getLocalityType()           Returns the current record's "LocalityType" value
 * @method Entity              getLocality1()              Returns the current record's "Locality1" value
 * @method Entity              getLocality2()              Returns the current record's "Locality2" value
 * @method EntityType          getEntityType()             Returns the current record's "EntityType" value
 * @method sfGuardUser         getSfGuardUser()            Returns the current record's "sfGuardUser" value
 * @method Doctrine_Collection getObservers()              Returns the current record's "Observers" collection
 * @method Doctrine_Collection getObservation()            Returns the current record's "Observation" collection
 * @method Doctrine_Collection getEntity()                 Returns the current record's "Entity" collection
 * @method Doctrine_Collection getDoor()                   Returns the current record's "Door" collection
 * @method Doctrine_Collection getAffectedDataSources()    Returns the current record's "AffectedDataSources" collection
 * @method Doctrine_Collection getDataSourceAffected()     Returns the current record's "DataSourceAffected" collection
 * @method Doctrine_Collection getSensor()                 Returns the current record's "Sensor" collection
 * @method Doctrine_Collection getMeasurement()            Returns the current record's "Measurement" collection
 * @method Entity              setId()                     Sets the current record's "id" value
 * @method Entity              setName()                   Sets the current record's "name" value
 * @method Entity              setComment()                Sets the current record's "comment" value
 * @method Entity              setType()                   Sets the current record's "type" value
 * @method Entity              setChannel()                Sets the current record's "channel" value
 * @method Entity              setErrorLowerLimit()        Sets the current record's "error_lower_limit" value
 * @method Entity              setWarningLowerLimit()      Sets the current record's "warning_lower_limit" value
 * @method Entity              setWarningUpperLimit()      Sets the current record's "warning_upper_limit" value
 * @method Entity              setErrorUpperLimit()        Sets the current record's "error_upper_limit" value
 * @method Entity              setSocialSecurityNumber()   Sets the current record's "social_security_number" value
 * @method Entity              setBornAt()                 Sets the current record's "born_at" value
 * @method Entity              setAddress()                Sets the current record's "address" value
 * @method Entity              setCalendarUrl()            Sets the current record's "calendar_url" value
 * @method Entity              setLocalityTypeId()         Sets the current record's "locality_type_id" value
 * @method Entity              setLocalityId()             Sets the current record's "locality_id" value
 * @method Entity              setLocality2Id()            Sets the current record's "locality2_id" value
 * @method Entity              setLocalityType()           Sets the current record's "LocalityType" value
 * @method Entity              setLocality1()              Sets the current record's "Locality1" value
 * @method Entity              setLocality2()              Sets the current record's "Locality2" value
 * @method Entity              setEntityType()             Sets the current record's "EntityType" value
 * @method Entity              setSfGuardUser()            Sets the current record's "sfGuardUser" value
 * @method Entity              setObservers()              Sets the current record's "Observers" collection
 * @method Entity              setObservation()            Sets the current record's "Observation" collection
 * @method Entity              setEntity()                 Sets the current record's "Entity" collection
 * @method Entity              setDoor()                   Sets the current record's "Door" collection
 * @method Entity              setAffectedDataSources()    Sets the current record's "AffectedDataSources" collection
 * @method Entity              setDataSourceAffected()     Sets the current record's "DataSourceAffected" collection
 * @method Entity              setSensor()                 Sets the current record's "Sensor" collection
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
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('channel', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('error_lower_limit', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('warning_lower_limit', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('warning_upper_limit', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('error_upper_limit', 'float', null, array(
             'type' => 'float',
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
        $this->hasColumn('calendar_url', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
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
             'ElectricStove' => 
             array(
              'type' => 'ElectricStove',
             ),
             'Cupboard' => 
             array(
              'type' => 'Cupboard',
             ),
             'Wardrobe' => 
             array(
              'type' => 'Wardrobe',
             ),
             'Fridge' => 
             array(
              'type' => 'Fridge',
             ),
             'Bed' => 
             array(
              'type' => 'Bed',
             ),
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
        $this->hasOne('LocalityType', array(
             'local' => 'locality_type_id',
             'foreign' => 'id'));

        $this->hasOne('Entity as Locality1', array(
             'local' => 'locality_id',
             'foreign' => 'id'));

        $this->hasOne('Entity as Locality2', array(
             'local' => 'locality2_id',
             'foreign' => 'id'));

        $this->hasOne('EntityType', array(
             'local' => 'type',
             'foreign' => 'className'));

        $this->hasOne('sfGuardUser', array(
             'local' => 'id',
             'foreign' => 'patient_id'));

        $this->hasMany('Observer as Observers', array(
             'refClass' => 'Observation',
             'local' => 'entity_id',
             'foreign' => 'observer_id'));

        $this->hasMany('Observation', array(
             'local' => 'id',
             'foreign' => 'entity_id'));

        $this->hasMany('Entity', array(
             'local' => 'id',
             'foreign' => 'locality_id'));

        $this->hasMany('Door', array(
             'local' => 'id',
             'foreign' => 'locality_id'));

        $this->hasMany('DataSource as AffectedDataSources', array(
             'refClass' => 'DataSourceAffected',
             'local' => 'data_source_id',
             'foreign' => 'id'));

        $this->hasMany('DataSourceAffected', array(
             'local' => 'id',
             'foreign' => 'data_source_id'));

        $this->hasMany('Sensor', array(
             'local' => 'id',
             'foreign' => 'data_source_id'));

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