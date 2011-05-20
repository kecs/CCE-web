#SensorDescription.conf
<?php
echo implode("\t", array(
    'PAN ID',
    'Extended ID',
    'Endpoint number',
    'Cluster ID',
    'Endpoint HGW ID',
    'Locality',
    'Length of side effect fields',
    'Side effect #1',
    '...',
    'Observed device ID',
    'Observed device type',
    'Warning lower limit',
    'Warning upper limit',
    'Error lower limit',
    'Error upper limit',
    'Remark',
    'URL',
));
?>

<?php
foreach ($dataSources as $dataSource) /* @var $dataSource DataSource */
{
  foreach ($dataSource->Sensor as $sensor) /* @var $sensor Sensor */
  {
    $part1 = array(
        $sensor->Device->pan_id,
        $sensor->Device->extended_id,
        dechex($sensor->endpoint_number),
        dechex($sensor->cluster_id),
        $sensor->hgw_id,
        $dataSource->getLocality()->id, //Locality
        count($dataSource->AffectedBy), //Length of side effect fields
    );

    $part2 = array();
    foreach ($dataSource->AffectedBy as $entity) /* @var $entity Entity */
    {
      $part2[] = $entity->id;
    }

    $part3 = array(
        $dataSource->getNode()->getParent()->id, //Observed device id
        $dataSource->getNode()->getParent()->EntityType->id, //Observed device type
        $dataSource->warning_lower_limit,
        $dataSource->warning_upper_limit,
        $dataSource->error_lower_limit,
        $dataSource->error_upper_limit,
        $dataSource->comment, //Remark
        "http://{$sf_request->getHost()}/datasource/{$dataSource->id}",
    );

    $parts = array_merge($part1, $part2, $part3);
    $parts = array_map(function ($part)
            {
              return empty($part) ? 'N/A' : $part;
            }, $parts);

    echo implode("\t", $parts);
    echo "\n";
  }
}
?>