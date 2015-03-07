<?php
/**
 * Printer class renders data into a single HTML string
 * using saved template for an email message.
 */
class EmailPrinter extends PrinterAbstract
{
  protected $loaderTemplateModel = 'EmailTemplate';

  /**
   * Render message body
   * @param array $data data for email template
   * @return string HTML
   */
  public function render($data)
  {
    $tpl = $this->twig->loadTemplate($this->template);
    return  $tpl->render(array(
      $this->model => $data,
      'settings'   => new SettingsTagsArray()
    ));
  }  
}