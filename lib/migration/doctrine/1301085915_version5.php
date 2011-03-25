<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('data_source_affected', 'data_source_affected_data_source_id_entity_id', array(
             'name' => 'data_source_affected_data_source_id_entity_id',
             'local' => 'data_source_id',
             'foreign' => 'id',
             'foreignTable' => 'entity',
             ));
        $this->createForeignKey('data_source_affected', 'data_source_affected_entity_id_entity_id', array(
             'name' => 'data_source_affected_entity_id_entity_id',
             'local' => 'entity_id',
             'foreign' => 'id',
             'foreignTable' => 'entity',
             ));
        $this->addIndex('data_source_affected', 'data_source_affected_data_source_id', array(
             'fields' => 
             array(
              0 => 'data_source_id',
             ),
             ));
        $this->addIndex('data_source_affected', 'data_source_affected_entity_id', array(
             'fields' => 
             array(
              0 => 'entity_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('data_source_affected', 'data_source_affected_data_source_id_entity_id');
        $this->dropForeignKey('data_source_affected', 'data_source_affected_entity_id_entity_id');
        $this->removeIndex('data_source_affected', 'data_source_affected_data_source_id', array(
             'fields' => 
             array(
              0 => 'data_source_id',
             ),
             ));
        $this->removeIndex('data_source_affected', 'data_source_affected_entity_id', array(
             'fields' => 
             array(
              0 => 'entity_id',
             ),
             ));
    }
}