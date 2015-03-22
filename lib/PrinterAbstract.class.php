<?php

abstract class PrinterAbstract 
{
	protected $model;
    protected $template;
    protected $templateModel = 'Template';
  
	/**
	 * @param string Model name
	 * @param mixed $template param needed by template loader
	 */
	public function __construct($model, $template)
	{
		$this->model    = strtolower($model);
		$this->template = $template;		
	}

	/**
	 * Get new twig environment
	 * 
	 * @param string $templateField the column in the template table to use as template
	 * @return Twig_Environment
	 */
	public function twig($templateField = 'template')
	{
		$twig = new Twig_Environment(
			new Twig_Loader_Database($this->templateModel, $templateField), 
			array('cache'=>sfConfig::get('sf_cache_dir'), 'auto_reload'=>true)
		);
    	$twig->addExtension(new Common_Twig_Extension());
    	return $twig;
	}
}
