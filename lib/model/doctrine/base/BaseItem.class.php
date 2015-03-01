<?php

/**
 * BaseItem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property decimal $quantity
 * @property decimal $discount
 * @property integer $common_id
 * @property integer $product_id
 * @property string $description
 * @property decimal $unitary_cost
 * @property Common $Common
 * @property Doctrine_Collection $Taxes
 * @property Product $Product
 * @property Doctrine_Collection $ItemTax
 * 
 * @method decimal             getQuantity()     Returns the current record's "quantity" value
 * @method decimal             getDiscount()     Returns the current record's "discount" value
 * @method integer             getCommonId()     Returns the current record's "common_id" value
 * @method integer             getProductId()    Returns the current record's "product_id" value
 * @method string              getDescription()  Returns the current record's "description" value
 * @method decimal             getUnitaryCost()  Returns the current record's "unitary_cost" value
 * @method Common              getCommon()       Returns the current record's "Common" value
 * @method Doctrine_Collection getTaxes()        Returns the current record's "Taxes" collection
 * @method Product             getProduct()      Returns the current record's "Product" value
 * @method Doctrine_Collection getItemTax()      Returns the current record's "ItemTax" collection
 * @method Item                setQuantity()     Sets the current record's "quantity" value
 * @method Item                setDiscount()     Sets the current record's "discount" value
 * @method Item                setCommonId()     Sets the current record's "common_id" value
 * @method Item                setProductId()    Sets the current record's "product_id" value
 * @method Item                setDescription()  Sets the current record's "description" value
 * @method Item                setUnitaryCost()  Sets the current record's "unitary_cost" value
 * @method Item                setCommon()       Sets the current record's "Common" value
 * @method Item                setTaxes()        Sets the current record's "Taxes" collection
 * @method Item                setProduct()      Sets the current record's "Product" value
 * @method Item                setItemTax()      Sets the current record's "ItemTax" collection
 * 
 * @package    siwapp
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseItem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('item');
        $this->hasColumn('quantity', 'decimal', 53, array(
             'type' => 'decimal',
             'scale' => 15,
             'notnull' => true,
             'default' => 1,
             'length' => 53,
             ));
        $this->hasColumn('discount', 'decimal', 53, array(
             'type' => 'decimal',
             'scale' => 2,
             'notnull' => true,
             'default' => 0,
             'length' => 53,
             ));
        $this->hasColumn('common_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('product_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('description', 'string', 20000, array(
             'type' => 'string',
             'length' => 20000,
             ));
        $this->hasColumn('unitary_cost', 'decimal', 53, array(
             'type' => 'decimal',
             'scale' => 15,
             'notnull' => true,
             'default' => 0,
             'length' => 53,
             ));


        $this->index('desc', array(
             'fields' => 
             array(
              0 => 'description',
             ),
             ));
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Common', array(
             'local' => 'common_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('Tax as Taxes', array(
             'refClass' => 'ItemTax',
             'local' => 'item_id',
             'foreign' => 'tax_id'));

        $this->hasOne('Product', array(
             'local' => 'product_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('ItemTax', array(
             'local' => 'id',
             'foreign' => 'item_id'));
    }
}