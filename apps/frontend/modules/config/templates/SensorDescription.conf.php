#SensorDescription.conf
Sensor HGW ID	Locality	Length of side effect fields	Side effect #1	...	Observed device	Function	Sensor Type	Interested State	Remark
<?php
foreach ($dataSources as $dataSource) /* @var $dataSource DataSource */
{
  foreach ($dataSource->Device as $device) /* @var $device Device */
  {

    echo implode("\t", array(
        $device->guid, //Sensor HGW ID
        $dataSource->getLocality()->id, //Locality
        0, //Length of side effect fields
        //Side effect #1
        //Side effect ...
        $dataSource->getNode()->getParent()->getType(), //Observed device
        "N/A", //Function
        "N/A", //Sensor Type
        "N/A", //Interested State
        empty($dataSource->comment) ? "N/A" : $dataSource->comment, //Remark
    ));
    echo "\n";
  }
}
?>