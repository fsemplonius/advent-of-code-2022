<?php

// Inspired by https://github.com/hyper-neutrino/advent-of-code/blob/main/2022/day16p2.py (also youtube available)
// cache is not used because of not enough memory, takes about 5 min. runtime.

include 'day16PuzzleInput.php';
$input = explode("\r\n", $s1);

$valves = array ();
while ($s1=next($input)) {
  $s1 = str_replace(array('Valve ', 'has flow rate=', '; tunnels lead to valves', '; tunnel leads to valve', ','), array(''), $s1);
  $sa1 = explode(' ', $s1);
  $valve = array_shift($sa1);
  $rate = array_shift($sa1);
  $valves[$valve] = array ('rate'=>$rate, 'tunnels'=>$sa1);
}

$nonEmpty = array();
foreach ($valves as $valve=>$value) {
  if ($valve != 'AA' and !$value['rate'])
    continue;
  if ($valve != 'AA')
    $nonEmpty[] = $valve;
  $valves[$valve]['dist'] = array ('AA' => 0, $valve => 0);
  $visited = array ($valve=>'x');
  $Q = array(array(0, $valve));
  while ($Q) {
    list ($distance, $pos) = array_shift($Q);
    foreach ($valves[$pos]['tunnels'] as $next) {
      if ($visited[$next])
        continue;
      $visited[$next] = 'x';
      if ($valves[$next]['rate']) {
        $valves[$valve]['dist'][$next] = $distance + 1;
     }
      $Q[] = array($distance+1, $next);
    }
  }
  unset($valves[$valve]['dist'][$valve]);
  if ($valve != 'AA') unset ($valves[$valve]['dist']['AA']);
}

$indices = array ();
foreach ($nonEmpty as $index=>$valve)
  $indices[$valve] = $index;

function dfs(&$valves, $indices, $time, $valve, $bitmask) {
  $maxval = 0;
  foreach ($valves[$valve]['dist'] as $next=>$pathTime) {
    if (!($bitmask & ($bit=1<<$indices[$next])) and
        ($remTime = $time-$pathTime-1) > 0) {
      $maxval = max($maxval, dfs($valves, $indices, $remTime, $next, $bitmask|$bit) + $valves[$next]['rate'] * $remTime);
    }
  }
  return $maxval;
}

$bit = (1 << count($nonEmpty)) - 1;
$result = 0;
for ($i=0; $i<(floor($bit+1)/2); $i++)
  $result = max ($result, dfs($valves, $indices, 26, 'AA', $i) +
                 dfs($valves, $indices, 26, 'AA', $bit^$i));

echo "Result: $result" ;

?>
