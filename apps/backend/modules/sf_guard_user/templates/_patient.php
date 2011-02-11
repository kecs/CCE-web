<?php if ($sf_guard_user->patient_id !== null): ?>
  <a href="<?php echo url_for('patient_edit', array('id' => $sf_guard_user->patient_id)) ?>">
    <img src="/sfAdminDashPlugin/images/edit.png" />
  <?php echo $sf_guard_user->PatientRole->name ?>
</a>
<?php else: ?>
    <a href="<?php echo url_for('user_createPatientRole', $sf_guard_user) ?>">
      <img src="/sfAdminDashPlugin/images/new.png" />
    </a>
<?php endif ?>

