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

for ($i=200; $i<=700; $i++)
  $rock[$i][$maxy+2] = '#';

//drawRock($rock);

while (true) {
  while (true) {
    $x = 500;
    $y = 0;
    while (true) {
      if ($rock[499][1] and $rock[500][1] and $rock[501][1]) break 3;
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
}

drawRock($rock);

function drawRock($rock) {
  echo "\n";
  for ($y=0; $y<=180; $y++) {
    for ($x=300; $x<=700; $x++) {
      if (!($s=$rock[$x][$y])) $s='.';
      echo $s;
    }
    echo "\n";
  }
}

$units = 1;
foreach ($rock as $row) {
  foreach ($row as $dest) 
    if ($dest == 'o') $units++;
}

echo "result: $units";

?>
