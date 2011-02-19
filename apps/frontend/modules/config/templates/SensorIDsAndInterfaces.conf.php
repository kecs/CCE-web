#SensorIDsAndInterfaces.conf
#Global ID name:string +uid	Short ID	Endpoint Number	Cluster ID	Sensor HGW ID	Activity	Profile ID	Profile	Probability (normal)	Probability (warning)	Probability (error)	Warning lower bound	Warning upper bound	Error lower bound	Error upper bound	Sending Period (in second)	Interface	isShareable	Remark	Expiration Time
<?php
foreach ($devices as $device) /* @var $device Device */
{
  echo implode("\t", array(
      $device->guid, //Global ID name:string +uid
      $device->id, //Short ID
      'N/A', //Endpoint Number
      'N/A', //Cluster ID
      'N/A', //Sensor HGW ID
      'N/A', //Activity
      'N/A', //Profile ID
      'N/A', //Profile
      'N/A', //Probability (normal)
      'N/A', //Probability (warning)
      'N/A', //Probability (error)
      'N/A', //Warning lower bound
      'N/A', //Warning upper bound
      'N/A', //Error lower bound
      'N/A', //Error upper bound
      'N/A', //Sending Period (in second)
      'N/A', //Interface
      'N/A', //isShareable
      $device->DataSource->comment, //Remark
      'N/A', //Expiration Time
  ));

  echo "\n";
}
?>