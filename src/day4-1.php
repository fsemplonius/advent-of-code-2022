<?php

include 'day4PuzzleInput.php';
$input = explode("\r\n", $s1);

$ass = 0;

while ($s1=next($input)) {
  $pairs = explode(',',  $s1);
  list ($p1, $p2) = explode('-', $pairs[0]);
  list ($p3, $p4) = explode('-', $pairs[1]);
  if ($p3 >= $p1 && $p4 <= $p2 or $p3 <= $p1 && $p4 >= $p2) $ass++;
}

echo "Result: $ass";

?>
