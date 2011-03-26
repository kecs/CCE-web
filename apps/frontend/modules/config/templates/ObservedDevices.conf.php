#ObservedDevices.conf
Description	Leírás	Value
<?php
foreach ($entityTypes as $entityType) /* @var $entityType EntityType */
{

  echo implode("\t", array(
      $entityType->Translation['en']->name,
      $entityType->Translation['hu']->name,
      $entityType->id,
  ));
  echo "\n";
}
?>