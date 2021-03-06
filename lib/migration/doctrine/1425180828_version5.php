<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('email_template', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => '8',
              'autoincrement' => '1',
              'primary' => '1',
             ),
             'name' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             'template' => 
             array(
              'type' => 'clob',
              'length' => '',
             ),
             'models' => 
             array(
              'type' => 'string',
              'length' => '200',
             ),
             'created_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'updated_at' => 
             array(
              'notnull' => '1',
              'type' => 'timestamp',
              'length' => '25',
             ),
             'slug' => 
             array(
              'type' => 'string',
              'length' => '255',
             ),
             ), array(
             'indexes' => 
             array(
              'email_template_sluggable' => 
              array(
              'fields' => 
              array(
               0 => 'slug',
              ),
              'type' => 'unique',
              ),
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('email_template');
    }
}