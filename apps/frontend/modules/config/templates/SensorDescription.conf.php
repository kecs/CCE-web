#SensorDescription.conf
Sensor HGW ID	Locality	Length of side effect fields	Side effect #1	...	Observed device	Function	Sensor Type	Interested State	Remark
<?php
foreach ($dataSources as $dataSource) /* @var $dataSource DataSource */
{
  foreach ($dataSource->Device as $device) /* @var $device Device */
  {
    $part1 = array(
        $device->guid, //Sensor HGW ID
        $dataSource->getLocality()->id, //Locality
        count($dataSource->AffectedBy), //Length of side effect fields
    );

    $part2 = array();
    foreach ($dataSource->AffectedBy as $entity) /* @var $entity Entity */
    {
      $part2[] = $entity->id;
    }

    $part3 = array(
        $dataSource->getNode()->getParent()->getType(), //Observed device
        "N/A", //Function
        "N/A", //Sensor Type
        "N/A", //Interested State
        empty($dataSource->comment) ? "N/A" : $dataSource->comment, //Remark
    );
    
    echo implode("\t", array_merge($part1, $part2, $part3));
    echo "\n";
  }
}
?>