<?php

include 'day8PuzzleInput.php';
$input = explode("\r\n", $s1);

$width = strlen($input[0])-1;
$count = 4 * $width;

for ($h=1; $h<$width; $h++)
  for ($v=1; $v<$width; $v++) {
    $found = true;
while (true) {
    // left -> right
    for ($i=1; $i<=$h; $i++) {
      if ($input[$v][$h] <= $input[$v][$i-1]) {
        $found = false;
        break;
      }
    }
  if ($found) break;
    // up -> down
    $found = true;
    for ($i=1; $i<=$v; $i++) {
      if ($input[$v][$h] <= $input[$i-1][$h]) {
        $found = false;
        break;
      }
    }
  if ($found) break;
   // down -> up
    $found = true;
    for ($i=$width-1; $i>=$v; $i--) {
      if ($input[$v][$h] <= $input[$i+1][$h]) {
        $found = false;
        break;
      }
    }
  if ($found) break;
    // right -> left
    $found = true;
    for ($i=$width-1; $i>=$h; $i--) {
      if ($input[$v][$h] <= $input[$v][$i+1]) {
        $found = false;
        break;
      }
    }
  break;
} // end while true
    if ($found) {
      $count++;
    }
  }

echo 'Result: ' . $count;

?>
