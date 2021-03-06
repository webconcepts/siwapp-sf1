<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version9 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createForeignKey('customer', 'customer_series_id_series_id', array(
             'name' => 'customer_series_id_series_id',
             'local' => 'series_id',
             'foreign' => 'id',
             'foreignTable' => 'series',
             'onUpdate' => '',
             'onDelete' => 'set null',
             ));
        $this->addIndex('customer', 'customer_series_id', array(
             'fields' => 
             array(
              0 => 'series_id',
             ),
             ));
    }

    public function down()
    {
        $this->dropForeignKey('customer', 'customer_series_id_series_id');
        $this->removeIndex('customer', 'customer_series_id', array(
             'fields' => 
             array(
              0 => 'series_id',
             ),
             ));
    }
}