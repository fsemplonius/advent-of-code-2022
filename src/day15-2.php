<?php

include 'day15PuzzleInput.php';
$input = explode("\r\n", $s1);

$limit = 4000000;
//$limit = 20;
$spots = array (-1);
$senBeacons = array ();
$xMin = $xMax = 0;
while ($s1=next($input)) {
  $s1 = str_replace(array('Sensor at x=', ': closest beacon is at x='), array('', ', y='), $s1);
  $senBeacons[] = explode(', y=', $s1);
}
$lenSenBeacons = count($senBeacons);

$yStrt = 0;
$rowsave = -1;
$count = 0;
while (true) {
  foreach ($senBeacons as $senBeacon) {
    $y = $yStrt;
    while (($sa1=beaconPos($senBeacon, $y)) != array(1,-1) and $y <= min($limit,$yStrt+500000)) {
      if ($sa1[0] <= $spots[$y]+1 and $sa1[1] > $spots[$y]) {
        $spots[$y] = $sa1[1];
      }
      $y++;
    }

    $yEnd = max($yEnd, $y-1);
    for ($y1=$yStrt; $y1<=$yEnd; $y1++) {
      if ($v=$spots[$y1] and $v >= $limit) {
        unset($spots[$y1]);
      }
      else
        break;
    }
    $yStrt = $y1;
  }
  if ($rowsave == $yStrt) {
    if ($count++ >= $lenSenBeacons) break;
  }
  else {
    $count = 0;
    $rowsave = $yStrt;
  }
}

function beaconPos($senBeacon, $y) {
  list ($Sx, $Sy, $Bx, $By) = $senBeacon;
  $d = abs($Bx-$Sx) + abs($By-$Sy);
  if ($y >= $Sy-$d and $y <= $Sy+$d) {
    if ($y < $Sy) { 		// top
      $xMin = $Sx+$Sy-$d-$y;
      $xMax = $Sx-$Sy+$d+$y;
    }
    else {				// Bottom
      $xMin = $Sx-$Sy-$d+$y;
      $xMax = $Sx+$Sy+$d-$y;
    }
    return array ($xMin, $xMax);
  }
  else
    return array (1, -1);
}

echo 'Result: ' . (4000000*($spots[$yStrt]+1) + $yStrt);

?>
