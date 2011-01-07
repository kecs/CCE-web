<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addactivity extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('activity', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 4,
             ),
             'entity_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 4,
             ),
             'data_source_id' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 4,
             ),
             'type' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 255,
             ),
             'start_time' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 4,
             ),
             'end_time' => 
             array(
              'type' => 'integer',
              'notnull' => true,
              'length' => 4,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_general_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('activity');
    }
}