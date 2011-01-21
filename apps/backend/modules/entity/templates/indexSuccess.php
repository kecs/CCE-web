<?php use_helper('I18N', 'Date', 'JavascriptBase') ?>
<div id="sf_admin_container">
  <?php include_partial('header') ?>

  <div class="nested_set_manager_holder" id="entity_nested_set_manager_holder">
    <?php echo get_partial('entity/nested_set_list', array('records' => $records)); ?>
    <div style="clear:both">&nbsp;</div>
  </div>

  <div class="sf_admin_actions">
    <ul class="sf_admin_actions">
      <li class="sf_admin_action_list">
        <?php echo link_to(__('Back to root list'), 'entity') ?>
    </ul>
  </div>
</div>



