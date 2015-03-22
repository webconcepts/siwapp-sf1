<?php
/**
 * Printer class renders data into a single HTML string
 * using saved template for an email message.
 */
class EmailPrinter extends PrinterAbstract
{
  protected $templateModel = 'EmailTemplate';

  /**
   * Render message body
   * @param array $data data for email template
   * @return string HTML
   */
  public function render($data)
  {
    $tpl = $this->twig()->loadTemplate($this->template);
    return  $tpl->render(array(
      $this->model => $data,
      'settings'   => new SettingsTagsArray()
    ));
  }

  /**
   * Render email subject line
   * @param array $data data for template
   * @return string HTML
   */
  public function renderSubject($data)
  {
    $tpl = $this->twig('subject')->loadTemplate($this->template);
    return  $tpl->render(array(
      $this->model => $data,
      'settings'   => new SettingsTagsArray()
    ));
  }  
}