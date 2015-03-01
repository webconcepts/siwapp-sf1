<?php

/**
 * EmailTemplateTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EmailTemplateTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object EmailTemplateTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EmailTemplate');
    }

	/**
	 * Returns the email template associated to $model
	 *
	 * @return EmailTemplate
	 * @author Enrique Martinez
	 */
	public static function getTemplateForModel($model='Invoice')
	{
		$templates = Doctrine::getTable('Template')->createQuery()
			->where('models LIKE ?', '%'.$model.'%')->limit(1)->execute();

		if ($templates->count())
			return $templates[0];
		else 
			throw new EmailTemplateNotFoundException('Template Not Found');
	}
}

class EmailTemplateNotFoundException extends Exception {}