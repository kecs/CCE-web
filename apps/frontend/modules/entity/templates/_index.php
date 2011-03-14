<ul>
  <?php foreach ($observants as $entity): /* @var $entity Entity */ ?>
  <li class="<?php echo ($selectedEntityId === $entity->id ? 'selected' : '') ?>">
      <a href="<?php echo url_for('entity_index', $entity) ?>"><?php echo $entity ?></a>
    </li>
  <?php endforeach ?>
</ul>