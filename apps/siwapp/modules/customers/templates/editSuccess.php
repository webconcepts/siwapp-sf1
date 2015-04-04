<?php
use_helper('JavascriptBase', 'jQuery');
include_stylesheets_for_form($customerForm);
include_javascripts_for_form($customerForm);

$customer = $customerForm->getObject();
?>
<div id="customer-container" class="content">
  
  <h2><?php echo $title ?></h2>
  <form action="<?php echo url_for("customers/$action") ?>" method="post" <?php $customerForm->isMultipart() and print 'enctype="multipart/form-data" ' ?> class="customer">
  <?php include_partial('common/globalErrors', array('form' => $customerForm)) ?>
  <?php
  echo $customerForm->renderHiddenFields();
  ?>
  <div id="customer-data" class="global-data block">
  <h3><?php echo __('Client info') ?></h3>
  <ul>
    <li>
      <span class="_75">
        <?php echo render_tag($customerForm['name'])?>
        <?php echo $customerForm['name_slug']->renderError()?>
      </span>
      <span class="_25"><?php echo render_tag($customerForm['identification'])?></span>
    </li>
    <li>
      <span class="_50"><?php echo render_tag($customerForm['contact_person'])?></span>
      <span class="_50"><?php echo render_tag($customerForm['email'])?></span>
    </li>
    <li>
      <span class="_50"><?php echo render_tag($customerForm['invoicing_address'])?></span>
      <span class="_50"><?php echo render_tag($customerForm['shipping_address'])?></span>
    </li>
    <?php echo $customerForm['series_id']->renderRow(array('class' => error_class($customerForm['series_id']))) ?>    
    <li>        
      <input name="create_customer_series" class="create_series" checked="checked" id="create_customer_series" type="checkbox" value="on" />
      <label for="create_customer_series" class="create_series">Create a new invoice series for this customer</label>
    </li>
  </ul>
</div>
  <div id="saving-options" class="block">
    <?php
    if ($customer->getId()) {
      echo gButton_to(__('Delete'), "customers/delete?id=" . $customer->getId(), array(
        'class' => 'action delete',
        'post' => true,
        'confirm' => __('Are you sure?'),
        ) , 'button=false')." ";
    }
    
    echo gButton(__('Save'), 'type=submit class=action primary save', 'button=true');
    ?>
  </div>
  </form>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
  $('#customer-data input[type=text], #customer-data textarea').SiwappFormTips(); // See invoice.js
  
  $('#customer_series_id').change(function(){
    if( $(this).val() ) {
      $('#create_customer_series')
        .attr('checked', false)
        .parent().hide();
    }
    else {
      $('#create_customer_series')
        .attr('checked', false)
        .parent().show();
    }
  }).trigger('change');
});

//]]>
</script>