<?php
  /**
   * Checks pending jobs on the recurring_invoice table
   * @author JoeZ  <jzarate@gmail.com>
   */
class CreatePendingInvoicesTask extends sfDoctrineBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // Custom options
      new sfCommandOption('date', null, sfCommandOption::PARAMETER_REQUIRED, 'Date', sfDate::getInstance()->dump())
      ));

      $this->namespace           = 'siwapp';
      $this->name                = 'create-pending-invoices';
      $this->briefDescription    = 'Generates all pending invoices';
      $this->detailedDescription = <<<EOF

The [create-pending-invoices|INFO] task checks the database and generates all pending invoices.
EOF;
  }
      
  protected function execute($arguments = array(), $options = array())
  {
    $config = $this->configuration;
    $appConfig = $config::getApplicationConfiguration($this->namespace, sfConfig::get('sf_environment'), true);
    sfContext::createInstance($appConfig);

    $databaseManager = new sfDatabaseManager($config);   
    
    // generate pending
    $invoices = RecurringInvoiceTable::createPendingInvoices();

    // send invoices
    $sender = new InvoiceSender($this->getMailer(), new sfI18n($appConfig));
    foreach( $invoices as $i )
    {      
      if($i->getRecurringInvoice()->send_on_create) 
      {
        if(!$sender->send($i))
        {
          $this->logBlock('Problem sending '.$i->getId().': '.$sender->error, 'ERROR');
        }
      }
    }
    
    $this->logSection('siwapp', 'Done');
  }

}