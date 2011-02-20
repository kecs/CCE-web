#HomeDescription.conf
<?php echo implode("\t", range(0, count($localities) - 1)) ?>	Number of windows
<?php
foreach ($localities as $i => $locality) /* @var $locality Locality */
{
  for ($j = 0; $j < count($localities); $j++)
  {
    if ($i == $j)
    {
      echo $locality->LocalityType->id;
    }
    else if ($i < $j)
    {
      echo $locality->isConnectedTo($localities[$j]->getRawValue()) ? "1" : "0";
    }
    else
    {
      echo '0';
    }
    echo "\t";
  }
  echo $locality->getWindowCount();
  echo "\n";
}
?>