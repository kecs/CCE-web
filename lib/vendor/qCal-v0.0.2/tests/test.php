<?php


function __autoload($className) {
	$paths = explode(PATH_SEPARATOR, get_include_path());
	foreach ($paths as $path) {
		$fileName = str_replace("_", DIRECTORY_SEPARATOR, $className);
	    if($exists = !class_exists($className) && file_exists($class = $path.DIRECTORY_SEPARATOR.$fileName.'.php')) {
	        require_once $class;
	    } elseif(!$exists) {
	        //eval('class '.$className.' extends Exception {}');
	        //throw new $className('[__autoload] this file doesn\'t exist: '.$class);
	    }
    }
}


set_include_path(realpath("../lib") . PATH_SEPARATOR . get_include_path());
$parser = new qCal_Parser();
$ical = $parser->parseFile('files/basic.ics'); /* @var $ical qCal_Component_Vcalendar */
foreach ($ical->getComponent('VEVENT') as $event) /* @var $event qCal_Component_Vevent */
{
  $recurrence = $event->getRecurrence();
  if ($recurrence)
  {
    $out = $recurrence->getRecurrences("20110520T180000Z", "20110528T180000Z");
    foreach ($out as $o)
    {
        print $o."\n";
    }
    print "\n\n";
  }
  
}
