<?php

include 'day9PuzzleInput.php';
$input = explode("\r\n", $s1);

$Hh = $Th = 0;
$Hv = $Tv = 4;
$grid = array ();
$grid[$Tv] = array($Th => '#');

while ($s1=next($input)) {
  list ($dir, $steps) = explode(' ', $s1);
  $first = true;
  for ($i=0; $i<$steps; $i++) {
    // move H
    switch ($dir) {
    case 'R':
      $Hh++;
      break;
    case 'L':
      $Hh--;
      break;
    case 'U':
      $Hv--;
      break;
    case 'D':
      $Hv++;
      break;
    }
    // check touching
    if ($Tv != $Hv) {
      if ($Tv < $Hv-1) {
        $Tv++;
      }
      elseif ($Tv > $Hv+1) {
        $Tv--;
      }
    }

    if ($Th != $Hh) {
      if ($Th < $Hh-1)
        $Th++;
      elseif ($Th > $Hh+1)
        $Th--;
    }

    if ($first) {
      if ($dir == 'L' || $dir == 'R') {
        if ($Hh != $Th) $first = false;
      }
      else {
        if ($Hv != $Tv) $first = false;
      }
    }
    else {
      if ($dir == 'L' or $dir == 'R') {
        $Tv = $Hv;
      }
      else {
        $Th = $Hh;
      }
    }
    $grid[$Tv][$Th] = '#';
  }
}

$result = 0;
foreach ($grid as $vert)
  foreach ($vert as $hor)
    $result++;

echo 'Result: ' . $result;

?>
