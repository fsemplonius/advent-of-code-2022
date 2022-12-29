<?php

include 'day16PuzzleInput.php';
$input = explode("\r\n", $s1);

$valves = array ();
while ($s1=next($input)) {
  $s1 = str_replace(array('Valve ', 'has flow rate=', '; tunnels lead to valves',
        '; tunnel leads to valve', ','), array(''), $s1);
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
  if ($s1=$cache[$time][$valve][$bitmask])
    return $s1;
  $maxval = 0;
  foreach ($valves[$valve]['dist'] as $next=>$pathTime) {
    if (!($bitmask & ($bit=1<<$indices[$next])) and ($remTime = $time-$pathTime-1) > 0) {
      $maxval = max($maxval, dfs($valves, $indices, $remTime, $next, $bitmask|$bit) +
                $valves[$next]['rate'] * $remTime);
    }
  }
  return ($cache[$time][$valve][$bitmask]=$maxval);
}

$result = dfs($valves, $indices, 30, 'AA', 0);

echo "Result: $result" ;

?>
