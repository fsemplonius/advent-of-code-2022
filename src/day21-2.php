<?php

include 'day21PuzzleInput.php';
$input = explode("\r\n", $s1);

$values = $funcs = array();
while ($s1=next($input)) {
  list ($name, $func) = explode (': ', $s1);
  if ($func > 0)
    $values[$name] = gmp_init($func);
  else {
    if (count($s2=explode(' + ', $func)) == 2)
      $mode = '+';
    elseif (count($s2=explode(' - ', $func)) == 2)
      $mode = '-';
    elseif (count($s2=explode(' * ', $func)) == 2)
      $mode = '*';
    elseif (count($s2=explode(' / ', $func)) == 2)
      $mode = '/';
    list ($n1, $n2) = $s2;
    $funcs[$name] = array('mode' => $mode, 'n1' => $n1, 'n2' => $n2);
  }
}

function findResult ($values, $funcs) {
  while (!isset($values['root'])) {
    $remove = array ();
    foreach ($funcs as $name => $solve) {
      if (isset($values[$solve['n1']]) and isset($values[$solve['n2']])) {
        switch ($solve['mode']) {
        case '+':
          $values[$name] = gmp_add($values[$solve['n1']], $values[$solve['n2']]);
          break;
        case '-':
          $values[$name] = gmp_sub($values[$solve['n1']], $values[$solve['n2']]);
          break;
        case '*':
          $values[$name] = gmp_mul($values[$solve['n1']], $values[$solve['n2']]);
          break;
        case '/':
          $values[$name] = gmp_div($values[$solve['n1']], $values[$solve['n2']]);
        }
        $remove[] = $name;
      }
    }
    foreach ($remove as $name)
      unset($funcs[$name]);
  }
  return $values['root'];
}

$funcs['root']['mode'] = '-';
$values['humn'] = gmp_init("10000000000000000");
$l1 = findResult($values, $funcs);
$values['humn'] = gmp_neg($values['humn']);
$l2 = findResult($values, $funcs);

while (true) {
  $values['humn'] = gmp_div(gmp_add($l1, $l2), 2);
  if (($b=gmp_sign(findResult($values, $funcs))) > 0)
    $l1 = $values['humn'];
  elseif ($b)
    $l2 = $values['humn'];
  else
    break;
}

echo 'Result: ' . gmp_strval($values['humn']);

?>
