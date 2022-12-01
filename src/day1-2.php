<?php

include 'day1PuzzleInput.php';
$input = explode("\r\n", $s1);
$top = array();

$sum = $s1 = 0;
do {
  do {
    $sum += $s1;
  } while ($s1=next($input));
  $top[] = $sum;
  $sum = 0;
} while (($s1=next($input)) != '9999');

sort($top);
$tot = end($top) + prev($top) + prev($top);

echo "Result: $tot";

?>
