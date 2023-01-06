<?php

include 'day18PuzzleInput.php';
$input = explode("\r\n", $s1);

$cubes = array ();
while ($s1 = next($input)) {
  list($x, $y, $z) = explode(',', $s1);
  $cubes[$x][$y][$z] = 'x';
}

reset($input);

$surface = 0;
while ($s1 = next($input)) {
  list ($x,$y,$z) = explode(',', $s1);
  $surface += 6;
  foreach(array(array(1,0,0),array(-1,0,0),array(0,1,0),array(0,-1,0),array(0,0,1),array(0,0,-1)) as $side)
    if ($cubes[$x+$side[0]][$y+$side[1]][$z+$side[2]]) $surface--;
}

echo 'Result: ' . $surface;

?>
