<h1><?php echo __('Observed entities') ?></h1>
<ul>
  <?php foreach ($observants as $entity): /* @var $entity Entity */ ?>
    <li>
      <a href="<?php echo url_for('entity_index', $entity) ?>"><?php echo $entity ?></a>
    </li>
  <?php endforeach ?>
</ul>