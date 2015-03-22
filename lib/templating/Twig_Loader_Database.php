<?php

class Twig_Loader_Database implements Twig_LoaderInterface
{
  protected $table;
  protected $templateField;

  public function __construct($templateModel = 'Template', $templateField = 'template')
  {    
    $this->table = Doctrine::getTable($templateModel);
    $this->templateField = $templateField;
  }

  public function getSource($name)
  {
    $get = 'get'.ucfirst($this->templateField); 
    return $this->findTemplate($name)->$get();
  }
  
  public function getCacheKey($name)
  {    
    return $this->templateField.'_'.$this->findTemplate($name)->getName();
  }
  
  public function isFresh($name, $time)
  {
    return strtotime($this->findTemplate($name)->getUpdatedAt()) < $time;
  }
  
  protected function findTemplate($name)
  {
    if (is_numeric($name))
    {
      $template = $this->table->find($name);
    }
    else
    {
      $template = $this->table->findOneBy('Slug', $name);
    }
    
    if (!$template)
    {
      throw new LogicException(sprintf('Template "%s" is not defined.', $name));
    }
    
    return $template;
  }
}
