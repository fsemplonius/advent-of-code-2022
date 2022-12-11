<?php

include 'day8PuzzleInput.php';
$input = explode("\r\n", $s1);

$width = strlen($input[0]);
$result = 0;

for ($h=0; $h<$width; $h++)
  for ($v=0; $v<$width; $v++) {
    $totCount = $count = 0;
    $k = $input[$v][$h];
    // left
    for ($i=$h-1; $i>=0; $i--) {
      $totCount++;
      if ($k <= $input[$v][$i]) {
        break;
      }
    }
    // up
    $count = 0;
    for ($i=$v-1; $i>=0; $i--) {
      $count++;
      if ($k <= $input[$i][$h]) {
        break;
      }
    }
    // down
    $totCount *= $count;
    $count = 0;
    for ($i=$v+1; $i<$width; $i++) {
      $count++;
      if ($k <= $input[$i][$h]) {
        break;
      }
    }
    // right
    $totCount *= $count;
    $count = 0;
    for ($i=$h+1; $i<$width; $i++) {
      $count++;
      if ($k <= $input[$v][$i]) {
        break;
      }
    }
    $result = max($totCount*$count, $result);
  }

echo 'Result: ' . $result;

?>
