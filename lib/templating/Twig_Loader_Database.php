<?php

class Twig_Loader_Database implements Twig_LoaderInterface
{
  protected $table;

  public function __construct($templateModel = 'Template')
  {
    $this->table = Doctrine::getTable($templateModel);
  }

  public function getSource($name)
  {
    return $this->findTemplate($name)->getTemplate();
  }
  
  public function getCacheKey($name)
  {
    return $this->findTemplate($name)->getName();
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
