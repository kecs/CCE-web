<h1><?php echo __('Measurements') ?></h1>
<?php foreach ($descendantEntities as $entity): /* @var $entity Entity */ ?>
<h2><?php echo $entity ?></h2>
<div class="<?php echo $entity->type ?>">
    <?php foreach ($entity->getActiveChannels() as $channel): ?>
  <div class="chart <?php echo $channel ?>">
    
  </div>
    <?php endforeach ?>
</div>
<?php endforeach ?>