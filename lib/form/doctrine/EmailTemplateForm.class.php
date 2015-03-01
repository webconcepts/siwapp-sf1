<?php

/**
 * EmailTemplate form.
 *
 * @package    siwapp
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmailTemplateForm extends BaseEmailTemplateForm
{
	public function getJavascripts()
	{
		return array_merge(parent::getJavascripts(), array('/js/siwapp/settings/editor.js'));
	}

	public function configure()
	{
		unset($this['created_at'], $this['updated_at'], $this['slug']);

		$this->widgetSchema['template'] = new sfWidgetFormEditArea(array('editarea_options' => array(
			'min_width'  => '900',
			'min_height' => '500',
			'font_size'  => '8',
			'syntax'     => 'html',
			'allow_resize' => 'y',
			'allow_toggle' => false,
			'replace_tab_by_spaces' => true,
			'toolbar'    => 'save, |, fullscreen, search, go_to_line, |, undo, redo, |, change_smooth_selection, highlight, reset_highlight, word_wrap',
			'save_callback' => "editarea_save_callback"
		)));

		$this->validatorSchema['name']->setOption('required', true);
		$this->validatorSchema['template']->setOption('required', true);
		$this->validatorSchema['name']->setMessage('required','The template name is required');
		$this->validatorSchema['template']->setMessage('required','The template content is required');

		$this->widgetSchema->setFormFormatterName('listB');
	}
}
