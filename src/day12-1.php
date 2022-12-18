<?php

// Based on BFS see wiki https://en.wikipedia.org/wiki/Breadth-first_search

include 'day12PuzzleInput.php';
$input = explode("\r\n", $s1);

$v = -1;
while ($s1=$input[++$v])
  if (($h=strpos($s1, 'S')) !== false) break;

$input[$v][$h] = '`';
$hmax = strlen($input[0]);
$vmax = count($input);
$Q = array (array($v, $h, 0));
$S = array ();

while ($Q) {
  list ($v, $h, $d) = array_shift($Q);
  if (in_array(array($v,$h), $S)) continue;
  $S[] = array ($v, $h);
  if ($input[$v][$h] == 'E') break;
  foreach (array(array(-1,0), array(0,1), array(1,0), array(0,-1)) as $p) {
    if (($v1=$v+$p[0]) >= 0 and $v1 < $vmax and
        ($h1=$h+$p[1]) >= 0 and $h1 < $hmax and
        ord($input[$v1][$h1]) <= ord($input[$v][$h])+1) {
      $Q[] = array($v1, $h1, $d+1);
    }
  }
}

echo 'Result: ' . $d;

?>
