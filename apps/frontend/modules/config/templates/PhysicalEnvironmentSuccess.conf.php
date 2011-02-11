#PhysicalEnvironment.conf
Description	Leírás	Value
<?php
foreach ($localityTypes as $localityType) /* @var $localityType LocalityType */
{
  echo "{$localityType->description}\t{$localityType->leiras}\t{$localityType->id}\n";
}
?>