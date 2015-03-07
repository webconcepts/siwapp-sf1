<?php

abstract class PrinterAbstract 
{
	protected $model;
    protected $template;
    protected $twig;

    protected $loaderTemplateModel = 'Template';
  
	/**
	 * @param string Model name
	 * @param mixed $template param needed by template loader
	 */
	public function __construct($model, $template)
	{
		$this->model    = strtolower($model);
		$this->template = $template;		

		$this->twig = new Twig_Environment(
			new Twig_Loader_Database($this->loaderTemplateModel), 
			array('cache'=>sfConfig::get('sf_cache_dir'), 'auto_reload'=>true)
		);
    	$this->twig->addExtension(new Common_Twig_Extension()); 
	}
}
