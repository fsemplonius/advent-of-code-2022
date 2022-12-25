<?php

include 'day15PuzzleInput.php';
$input = explode("\r\n", $s1);

$row = 2000000;
$spots = $senBeacons = array ();
$xMin = $xMax = 0;
while ($s1=next($input)) {
  $s1 = str_replace(array('Sensor at x=', ': closest beacon is at x='), array('', ', y='), $s1);
  list ($Sx, $Sy, $Bx, $By) = explode(', y=', $s1);
  $d = ($dx=abs($Bx-$Sx)) + ($dy=abs($By-$Sy));
  if ($Sy == $row)
    if (!in_array($Sx, $senBeacons)) $senBeacons[] = $Sx;
  if ($By == $row)
    if (!in_array($Bx, $senBeacons)) $senBeacons[] = $Bx;
  $n = 0;
  for ($y=$Sy-$d; $y<=$Sy+$d; $y++) {
    if ($y == $row) {
      $spots[] = array($Sx-$n, $Sx+$n);
      $xMin = min($xMin, $Sx-$n);
      $xMax = max($xMax, $Sx+$n);
    }
    $n = $y<$Sy ? $n+1: $n-1;
  }
}

$count = 0;
for ($i=$xMin; $i<=$xMax; $i++) {
  foreach($spots as $spot) {
    if ($spot[0] <= $i and $spot[1] >= $i) {
      $count++;
      break;
    }
  }
}

foreach ($senBeacons as $senBeacon) {
  foreach($spots as $spot) {
    if ($spot[0] <= $senBeacon and $spot[1] >= $senBeacon) {
      $count--;
      break;
    }
  }
}

echo 'Result: ' . $count;

?>
