<?php

include 'day6PuzzleInput.php';

$i = $k = 2;
while ($s1[$i]) {
  for ($j=$i-1; $j>$i-13 and $j>=0; $j--) {
    if ($s1[$j] == $s1[$i]) {
      $k = max($k, $j);
      break;
    }
  }
  if ($k < $i-13) break;
  $i++;
}

$i++;
echo "Result: $i";

?>
