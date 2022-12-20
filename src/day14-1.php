<?php

include 'day14PuzzleInput.php';
$input = explode("\r\n", $s1);

$rock = array();
$maxy = 0;
while ($s1=next($input)) {
  $points = explode(' -> ', $s1);
  $first = true;
  foreach($points as $point) {
    list ($x, $y) = explode(',', $point);
    $maxy = max($y, $maxy);
    if ($first) {
      $x1 = $x;
      $y1 = $y;
      $maxy = max($y1, $maxy);
      $first = false;
      continue;
    }
    if ($x == $x1) {
      if ($y - $y1 > 0) {
        for ($i=$y1; $i<=$y; $i++)
          $rock[$x][$i] = '#';
      }
      else {
        for ($i=$y; $i<=$y1; $i++)
          $rock[$x][$i] = '#';
      }
    }
    else {
      if ($x - $x1 > 0) {
        for ($i=$x1; $i<=$x; $i++)
          $rock[$i][$y] = '#';
      }
      else {
        for ($i=$x; $i<=$x1; $i++)
          $rock[$i][$y] = '#';
      }
    }
    $x1 = $x;
    $y1 = $y;
  }
}

//drawRock($rock);

while ($y <= $maxy) {
  while ($y <= $maxy) {
    $x = 500;
    $y = 0;
    while ($y <= $maxy) {
      if (!$rock[$x][$y+1]) {
        $y++;
      }
      elseif (!$rock[$x-1][$y+1]) {
        $x--;
        $y++;
      }
      elseif (!$rock[$x+1][$y+1]) {
        $x++;
        $y++;
      }
      else {
        $rock[$x][$y] = 'o';
        break;
      }
    }
  }
//  drawRock($rock);
}

function drawRock($rock) {
  echo "\n";
  for ($y=0; $y<=10; $y++) {
    for ($x=493; $x<=503; $x++) {
      if (!($s=$rock[$x][$y])) $s='.';
      echo $s;
    }
    echo "\n";
  }
}

$units = 0;
foreach ($rock as $row) {
  foreach ($row as $dest) 
    if ($dest == 'o') $units++;
}

echo "result: $units";

?>
