<?php

include 'day10PuzzleInput.php';
$input = explode("\r\n", $s1);

$result = array ();
$cycle = $valX = 1;

function chkCycle($cycle, $valX, &$result) {
  $result[$cycle-1] = (($valX+2) >= $cycle%40 and ($valX) <= $cycle%40) ? '#' : '.';
}

while ($s1=next($input)) {
  list ($instr, $num) = explode(' ', $s1);
  if ($instr == 'addx') {
    chkCycle($cycle++, $valX, $result);
    chkCycle($cycle++, $valX, $result);
    $valX += $num;
  }
  else
    chkCycle($cycle++, $valX, $result);
}

for ($i=0; $i<240; $i++) {
  if ($i % 40 == 0) echo "\n";
  echo $result[$i];
}
?>
