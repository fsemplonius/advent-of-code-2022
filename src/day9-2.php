<?php

include 'day9PuzzleInput.php';
$input = explode("\r\n", $s1);

$len = 10;
$H = $V = array ();
for ($i=0; $i<$len; $i++) {
  $H[$i] = 11;
  $V[$i] = 15;
}
$grid = array ();

$grid[$V[0]] = array($H[0] => '#');

while ($s1=next($input)) {
  list ($dir, $steps) = explode(' ', $s1);
  $plus = true;
  for ($i=0; $i<$steps; $i++) {
    // move H
    switch ($dir) {
    case 'R':
      $H[0]++;
      break;
    case 'L':
      $H[0]--;
      $plus = false;
      break;
    case 'U':
      $V[0]--;
      break;
    case 'D':
      $plus = false;
      $V[0]++;
      break;
    }
    for ($k=1; $k<$len; $k++) { 

      // check touching
      if ($H[$k]+2 == $H[$k-1] and $V[$k]+2 == $V[$k-1]) {
        $H[$k]++;
        $V[$k]++;
      }
      elseif ($H[$k]-2 == $H[$k-1] and $V[$k]+2 == $V[$k-1]) {
        $H[$k]--;
        $V[$k]++;
      }
      elseif ($H[$k]+2 == $H[$k-1] and $V[$k]-2 == $V[$k-1]) {
        $H[$k]++;
        $V[$k]--;
      }
      elseif ($H[$k]-2 == $H[$k-1] and $V[$k]-2 == $V[$k-1]) {
        $H[$k]--;
        $V[$k]--;
      }

      $mv = false;
      if ($V[$k] != $V[$k-1]) {
        if ($V[$k] < $V[$k-1]-1) {
          $V[$k]++;
          $mv = true;
        }
        elseif ($V[$k] > $V[$k-1]+1) {
          $V[$k]--;
          $mv = true;
        }
        if ($mv) $H[$k] = $H[$k-1];
      }

      $mv = false;
      if ($H[$k] != $H[$k-1]) {
        if ($H[$k] < $H[$k-1]-1) {
          $H[$k]++;
          $mv = true;
        }
        elseif ($H[$k] > $H[$k-1]+1) {
          $H[$k]--;
          $mv = true;
        }
        if ($mv) $V[$k] = $V[$k-1];
      }

/*
echo "$s1 k $k ". $H[$k-1].' '.$V[$k-1].' '.$H[$k].' '.$V[$k]."\n";

      for ($j=0; $j<26; $j++)
        for ($n=0; $n<26; $n++)
          $grid[$j][$n] = '.';

      for ($j=0; $j<$len; $j++)
        $grid[$V[$j]][$H[$j]] = "$j";

      for ($j=0; $j<26; $j++) {
        for ($n=0; $n<26; $n++)
          echo $grid[$j][$n];
        echo "\n";
      }
*/
      $gridVisit [$V[$len-1]][$H[$len-1]] = '#';
    }
  }
}

$result = 0;
foreach ($gridVisit as $vert)
  foreach ($vert as $hor)
    $result++;

echo 'Result: ' . $result;

?>
