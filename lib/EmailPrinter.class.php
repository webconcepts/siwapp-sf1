<?php
/**
 * Printer class renders data into a single HTML string
 * using saved template for an email message.
 * 
 * Copied an adapted from Printer class, by Carlos Escribano <carlos@markhaus.com>
 *
 * Usage:
 *
 * $printer = new Printer('ModelClass', $templateForLoader);
 *
 * // loader is Twig_Loader_Database by default so $templateForLoader should be int
 * $data = array(array('a' => 1), array('a' => 2), ...);
 * $htm = $printer->render($data);
 * $pdf = $printer->renderPdf($data);
 */
class EmailPrinter
{
  protected
    $model,
    $template,
    $loader;
  
  /**
   * @param string Model name
   * @param mixed $template param needed by template loader
   */
  public function __construct($model, $template)
  {
    $this->model    = strtolower($model);
    $this->template = $template;
    $this->loader   = new Twig_Loader_Database('EmailTemplate');
  }

  /**
   * Render message body
   * @param array $data data for email template
   * @return string HTML
   */
  public function render($data)
  {
    $twig = new Twig_Environment($this->loader, array('cache'=>sfConfig::get('sf_cache_dir'), 'auto_reload'=>true));
    $twig->addExtension(new Common_Twig_Extension()); 
    
    $tpl = $twig->loadTemplate($this->template);
    
    return  $tpl->render(array(
      $this->model => $data,
      'settings'   => new SettingsTagsArray()
    ));
  }  
}