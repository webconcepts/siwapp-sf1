<?php

class InvoiceSender 
{
	public $error = false;

	protected $mailer;
	protected $i18n;

	public function __construct(sfMailer $mailer = null, sfI18N $i18n = null)
	{
		if($mailer) 
		{
			$this->setMailer($mailer);
		}
		if($i18n) 
		{
			$this->setI18n($i18n);
		}
	}

	/**
	 * Send invoice to client by email.
	 * Any error message will be available at InvoiceMailer->error.
	 * 
	 * @param Invoice $invoice
	 * @return bool success
	 */
	public function send(Invoice $invoice)
	{
		$result = false;
		$this->error = false;

		try
		{
			$message = new InvoiceMessage($invoice, $this->i18n);
			if($message->getReadyState())
			{
				$result = $this->mailer->send($message, $failedRecipients);
				if($result)
				{
					$invoice->setSentByEmail(true);
					$invoice->save();
				}
				if( !empty($failedRecipients) )
				{
					$this->error = 'Failed to send to '.implode(', ', $failedRecipients);
					return false;
				}
			}
		} 
		catch (Exception $e) 
		{
			$this->error = $e->getMessage();
			$result = false;
		}
		return $result;
	}

	/**
	 * Set mailer instance for use sending invoice
	 * 
	 * @param sfMailer $mailer
	 */
	public function setMailer(sfMailer $mailer)
	{
		$this->mailer = $mailer;
	}

	/**
	 * Set i18n instance for use in invoice message
	 * 
	 * @param sfI18n $i18n
	 */
	public function setI18n(sfI18N $i18n)
	{
		$this->i18n = $i18n;
	}
}