<?php if ($sf_guard_user->observer_id !== null): ?>
  <a href="<?php echo url_for('observer_edit', array('id' => $sf_guard_user->observer_id)) ?>">
    <img src="/sfAdminDashPlugin/images/edit.png" />
  </a>
<?php else: ?>
    <a href="<?php echo url_for('user_createObserverRole', $sf_guard_user) ?>">
      <img src="/sfAdminDashPlugin/images/new.png" />
    </a>
<?php endif ?>

