<?php

include 'day10PuzzleInput.php';
$input = explode("\r\n", $s1);

$result = 0;
$cycle = $valX = 1;

function chkCycle($cycle, $valX, &$result) {
  if (in_array($cycle, array (20, 60, 100, 140, 180, 220)))
    $result += $valX * $cycle;
}

while ($s1=next($input)) {
echo $s1;
  list ($instr, $num) = explode(' ', $s1);
  if ($instr == 'addx') {
    chkCycle($cycle++, $valX, $result);
    chkCycle($cycle++, $valX, $result);
    $valX += $num;
  }
  else
    chkCycle($cycle++, $valX, $result);
echo " X $valX cycle $cycle result $result\n";
}

echo 'Result: ' . $result;

?>
