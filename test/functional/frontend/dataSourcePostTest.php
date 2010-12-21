<?php

include(dirname(__FILE__) . '/../../bootstrap/functional.php');

$b = new CceTestFunctionalFrontend(new cceBrowser());

$b->info('Activity test');

$aboutId = 1;
$sourceId = 5;
$channel = 'activity';
$type = 'testActivityType';
$startTime = '1292521231';
$endTime = '1292621231';

$content = <<<EOM
<?xml version="1.0" encoding="UTF-8"?>
<activity>
  <type>$type</type>
  <start>$startTime</start>
  <end>$endTime</end>
</activity>
EOM;

$b->setHttpHeader("Content-Type",	"application/xml");
$b->post("/datasource/$sourceId/$channel", array('content' => $content))
        ->with('response')
        ->isStatusCode(200);


$m = Doctrine_Core::getTable('Activity')->findOneBy('start_time', $startTime); /* @var $m Activity */

$b->test()->is($m->Source->id, $sourceId, "Datasource ID is $sourceId");
$b->test()->is($m->About->id, $aboutId, "About entity ID is $aboutId");
$b->test()->is($m->type, $type, "Activity type is $type");
$b->test()->is($m->start_time, $startTime, "Activity start time is $startTime");
$b->test()->is($m->end_time, $endTime, "Activity end time is $endTime");


$b->resetDatabase();