<?php load_assets('entity_indexRecursive') ?>
<?php use_javascript(url_for('javascript')) ?>

<h1><?php echo __('Measurements') ?></h1>
<?php foreach ($descendantEntities as $entity): /* @var $entity Entity */ ?>
  <div class="entity" data-type="<?php echo $entity->type ?>" data-id="<?php echo $entity->id ?>">
    <h2 style="margin-left: <?php echo $entity->getNode()->getLevel() * 15 ?>px"><?php echo $entity ?></h2>
    <div class="details">
    <?php if (count($activeChannels = $entity->getActiveChannels())): ?>
    <?php foreach ($entity->getActiveChannels() as $channel): ?>
        <div class="channel chart" data-channel="<?php echo $channel ?>">
        </div>
    <?php endforeach ?>
    <?php elseif (!$entity->getNode()->hasChildren()): ?>
          <div class="note">
      <?php echo __('No data') ?>
        </div>
    <?php endif ?>
        </div>
      </div>
<?php endforeach ?>