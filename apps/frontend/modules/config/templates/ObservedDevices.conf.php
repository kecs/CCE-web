#ObservedDevices.conf
Description	Leírás	Value
<?php
$origCulture = sfContext::getInstance()->getI18N()->getCulture();
sfContext::getInstance()->getI18N()->setCulture('hu');

foreach ($entityTables as $i => $entityTable) /* @var $entityTable EntityTable */
{

  echo implode("\t", array(
      $entityTable->getDescription(),
      __($entityTable->getDescription()),
      $i,
  ));
  echo "\n";
}

sfContext::getInstance()->getI18N()->setCulture($origCulture);
?>