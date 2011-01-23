<h1><?php echo __('Patients') ?></h1>
<ul>
  <?php foreach ($patients as $patient): /* @var $patient Patient */?>
  <li>
    <a href="<?php echo url_for('entity_index', $patient->getHome()) ?>"><?php echo $patient ?></a>
  </li>
  <?php endforeach ?>
</ul>