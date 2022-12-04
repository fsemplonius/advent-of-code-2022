<?php

include 'day4PuzzleInput.php';
$input = explode("\r\n", $s1);

$ass = 0;

while ($s1=next($input)) {
  $pairs = explode(',',  $s1);
  list ($p1, $p2) = explode('-', $pairs[0]);
  list ($p3, $p4) = explode('-', $pairs[1]);
  if ($p3 <= $p2 and $p4 >= $p1) $ass++;
}

echo "Result: $ass";

?>
