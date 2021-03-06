<?php

/**
 * BaseInvoice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property RecurringInvoice $RecurringInvoice
 * @property Doctrine_Collection $Payments
 * 
 * @method RecurringInvoice    getRecurringInvoice() Returns the current record's "RecurringInvoice" value
 * @method Doctrine_Collection getPayments()         Returns the current record's "Payments" collection
 * @method Invoice             setRecurringInvoice() Sets the current record's "RecurringInvoice" value
 * @method Invoice             setPayments()         Sets the current record's "Payments" collection
 * 
 * @package    siwapp
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvoice extends Common
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('RecurringInvoice', array(
             'local' => 'recurring_invoice_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Payment as Payments', array(
             'local' => 'id',
             'foreign' => 'invoice_id'));
    }
}