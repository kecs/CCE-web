<?php if (!$records) :?>
	<?php include_partial('entity/list_actions_no_root', array('model' => $model, 'root' => $root)) ?>
<?php else : ?>
	<?php include_partial('entity/list_actions_tree', array('model' => $model, 'root' => $root, 'hasManyRoots' => $hasManyRoots)) ?>
<?php endif; ?>