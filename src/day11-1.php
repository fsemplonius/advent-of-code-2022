<?php

include 'day11PuzzleInput.php';
$input = explode("\r\n", $s1);

$rounds = 20;
$monkeys = $insp = array ();

while ($s1=next($input)) {
  $monkey = str_replace(array('Monkey ', ':'), '', $s1);
  $monkeys[$monkey]['items'] = explode(', ', substr(next($input), 18));
  $s2 = next($input);
  $monkeys[$monkey]['ops'] = array ($s2[23], substr($s2, 25));
  $monkeys[$monkey]['test'] = substr(next($input), 21);
  $monkeys[$monkey]['des'] = array(substr(next($input), 29), substr(next($input), 30));
  next($input);
}

for ($i=0; $i<$rounds; $i++) {
  $j = -1;
  while ($monkeys[++$j]) {
    foreach ($monkeys[$j]['items'] as $item) {
      if ($monkeys[$j]['ops'][0] == '+')
        $worry = $item + $monkeys[$j]['ops'][1];
      elseif ($monkeys[$j]['ops'][1] == 'old')
        $worry = $item * $item;
      else
        $worry = $item * $monkeys[$j]['ops'][1];
      if (($w3=floor($worry/3)) % $monkeys[$j]['test'] == 0)
        $monkeys[$monkeys[$j]['des'][0]]['items'][] = $w3;
      else
        $monkeys[$monkeys[$j]['des'][1]]['items'][] = $w3;
      $insp[$j]++;
    }
    $monkeys[$j]['items'] = array ();
  }
}

rsort($insp);

echo 'Result: ' . ($insp[0]*$insp[1]);

?>
