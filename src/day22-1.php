<?php

include 'day22PuzzleInput.php';
$input = explode("\r\n\r\n", $s1);

$s1 = explode("\r\n", $input[0]);
$strLen = 0;
foreach ($s1 as $line)
  $strLen = max($strLen, strlen($line));

$map[] = str_repeat(' ', $strLen+2);
foreach ($s1 as $line)
  $map[] = " $line".str_repeat(' ', $strLen-strlen($line)+1);
$map[] = str_repeat(' ', $strLen+2);

$path = $input[1];

$h = strpos($map[1], '.');
$v = 1;
$cDir = 0;		// 0 => r; 1 => d; 2 => l; 3 => up (v,h)
$dir = array(array(0,1), array(1,0), array(0,-1), array(-1,0));

$i = -1;
while ($s1 = $path[++$i]) {
  if ($s1 >= '0' and $s1 <= '9') {
    $n1 = (int) $s1;
    while (($n2=$path[$i+1]) >= '0' and $n2 <= '9') {
      $n1 = $n1*10 + (int) $n2;
      $i++;
    }
    for ($k=0; $k<$n1; $k++) {
      $v += $dir[$cDir][0];
      $h += $dir[$cDir][1];
      if (($p=$map[$v][$h]) == '.')
        continue;
      elseif ($p == '#') {
        $v -= $dir[$cDir][0];
        $h -= $dir[$cDir][1];
      }
      else {
        switch ($cDir) {
        case 0:
          $j = --$h;
          while ($map[$v][$j-1] != ' ') $j--;
          if ($map[$v][$j] != '#') $h = $j;
          break;
        case 1:
          $j = --$v;
          while ($map[$j-1][$h] != ' ') $j--;
          if ($map[$j][$h] != '#') $v = $j;
          break;
        case 2:
          $j = ++$h;
          while ($map[$v][$j+1] != ' ') $j++;
          if ($map[$v][$j] != '#') $h = $j;
          break;
        case 3:
          $j = ++$v;
          while ($map[$j+1][$h] != ' ') $j++;
          if ($map[$j][$h] != '#') $v = $j;
        }
      }
    }
  }
  elseif ($s1 == 'R')
    $cDir = (++$cDir%4);
  elseif ($s1 == 'L')
    if (--$cDir < 0) $cDir += 4;
}

echo 'Result: ' . (1000 * $v + 4 * $h + $cDir);

?>
