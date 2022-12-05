<?php

include 'day5PuzzleInput.php';
$input = explode("\r\n", $s1);

$lines = $stacks = array();

while (($s1=next($input))[1] != '1')
  array_unshift($lines, $s1);

$n = 1;
while ($s1[$n]) {
  $stack[$s1[$n]] = array ();
  foreach ($lines as $line)
    if ($line[$n] != ' ') $stacks[$s1[$n]][] = $line[$n];
  $n += 4;
}

next($input);
while ($s2=next($input)) {
  list ($dum1, $n, $dum2, $fr, $dum3, $to) = explode(' ', $s2);
  $s3 = array ();
  for ($i=0; $i<$n; $i++)
    $s3[] = array_pop($stacks[$fr]);
  for ($i=0; $i<$n; $i++)
    $stacks[$to][] = array_pop($s3);
}

$result = '';
foreach ($stacks as $stack)
  $result .= end($stack);

echo "Result: $result";

?>
