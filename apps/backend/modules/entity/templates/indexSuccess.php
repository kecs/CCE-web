<?php $model = 'Entity' ?>
<?php $root = 0 ?>

<?php load_assets('sfJqueryTree') ?>

<?php use_helper('I18N', 'Date', 'JavascriptBase') ?>
<?php include_partial('entity/assets') ?>
<div id="sf_admin_container">
  <h1><?php echo sfInflector::humanize(sfInflector::underscore($model)); ?> Nested Set Manager</h1>
  <?php include_partial('entity/flashes') ?>
  <?php if ($hasManyRoots && !$sf_request->hasParameter('root')): ?>
    <?php
    include_partial('entity/manager_roots', array(
        'model' => $model,
        'root' => $root,
        'roots' => $roots,
    ))
    ?>
  <?php else: ?>
    <?php
    include_partial('entity/manager_tree', array(
        'model' => $model,
        'root' => $root,
        'records' => $records,
        'hasManyRoots' => $hasManyRoots,
    ))
    ?>
<?php endif; ?>	
</div>



