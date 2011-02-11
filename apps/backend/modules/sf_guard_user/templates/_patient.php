<?php if ($sf_guard_user->patient_id !== null): ?>
<a href="<?php echo url_for('patient_edit', array('id' => $sf_guard_user->patient_id)) ?>">
  <?php echo $sf_guard_user->PatientRole->name ?>
</a>
<?php endif?>

