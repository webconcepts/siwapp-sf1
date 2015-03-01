<?php include_javascripts_for_form($form) ?>

<?php include_partial('configuration/navigation') ?>

<div id="settings-wrapper" class="content">
  
  <form id="email-template-form" name="email_template_form" method="post"
    action="<?php echo url_for('@emailtemplates?action=edit'.($form->getObject()->isNew() ? null : '&id='.$form->getObject()->getId())) ?>">
    <?php if (!$form->getObject()->isNew()): ?>
      <input type="hidden" name="sf_method" value="put" />
    <?php endif ?>
    <fieldset>
      <ul>
        <?php echo $form ?>
        <li class="text-right">
          <?php echo gButton_to('Cancel', '@emailtemplates', 'class=action cancel') ?> <?php echo gButton('Save', 'type=submit class=action save') ?> 
        </li>
      </ul>
    </fieldset>
  </form>
  
</div>