<?php

include 'day6PuzzleInput.php';

$i = 3;
while ($s1[$i]) {
  if ($s1[$i] != $s1[$i-1] and $s1[$i] != $s1[$i-2] and $s1[$i] != $s1[$i-3] and
      $s1[$i-1] != $s1[$i-2] and $s1[$i-1] != $s1[$i-3] and
      $s1[$i-2] != $s1[$i-3]) break;
  $i++;
}

$i++;
echo "Result: " . $i;

?>
