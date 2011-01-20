<div>
  <form id="<?php echo strtolower($model); ?>_root_create" action="<?php echo url_for('entity/Add_root'); ?>" method="post">
    <label for="<?php echo strtolower($model); ?>_type">Type: </label>
    <input type="text" id="type" name="type"/>
    <input type="hidden" name="model" value="<?php echo $model ?>"/>
    <button type="submit">
      <img class="actionImage" src="/assets/TreeManager/node-insert-next.png" /><?php echo __('Create Root'); ?>
    </button>
  </form>
</div>
