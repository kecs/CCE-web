<?php load_assets('entity_indexRecursive') ?>
<?php use_javascript(url_for('javascript')) ?>

<h1><?php echo __('Measurements') ?></h1>
<?php foreach ($descendantEntities as $entity): /* @var $entity Entity */ ?>
  <div class="entity" data-type="<?php echo $entity->type ?>" data-id="<?php echo $entity->id ?>">
    <h2><?php echo $entity ?></h2>
    <div class="details">
    <?php foreach ($entity->getActiveChannels() as $channel): ?>
      <div class="channel chart" data-channel="<?php echo $channel ?>">
      </div>
    <?php endforeach ?>
    </div>
  </div>
<?php endforeach ?>