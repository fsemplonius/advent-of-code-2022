<?php

include 'day1PuzzleInput.php';
$input = explode("\r\n", $s1);

$tot = $sum = $s1 = 0;
do {
  do {
    $sum += $s1;
  } while ($s1=next($input));
  $tot = max($tot, $sum);
  $sum = 0;
} while (($s1=next($input)) != '9999');

echo "Result: $tot";

?>
