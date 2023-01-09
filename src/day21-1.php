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

echo 'Result: ' . gmp_strval($values['root']);

?>
