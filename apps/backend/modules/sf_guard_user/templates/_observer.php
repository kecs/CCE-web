<?php if ($sf_guard_user->observer_id !== null): ?>
<a href="<?php echo url_for('observer_edit', array('id' => $sf_guard_user->observer_id)) ?>">
  <img src="/sfAdminDashPlugin/images/tick.png" />
</a>
<?php endif?>

