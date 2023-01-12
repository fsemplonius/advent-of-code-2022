<?php

include 'day22PuzzleInput.php';
$input = explode("\r\n\r\n", $s1);

$s1 = explode("\r\n", $input[0]);
$sideLen = strlen($s1[0]) / 3;

/*
                  L         N
             ----------------------
             |    A         B     |
             |                    |
            I|C                  D|J
             |                    |
             |              E     |
             |          O----------
             |          |   G
             |          |
            H|F        G|E
             |          |
       F     |          |
  -----------P          |
  |    H                |
  |                     |
 C|I                   J|D
  |                     |
  |               K     |
  |          Q-----------
  |          |    M
  |          |
 A|L        M|K
  |          |
  |    N     |
  ------------
       B
*/

$map[] = str_repeat(' ', $sideLen*3);
foreach ($s1 as $line)
  $map[] = " $line";
$map[] = str_repeat(' ', $sideLen*3);
for ($i=0; $i<$sideLen; $i++) {
  $map[0][$sideLen+1+$i] = 'A';
  $map[0][$sideLen*2+1+$i] = 'B';
  $map[$i+1][$sideLen] = 'C';
  $map[$i+1][$sideLen*3+1] = 'D';
  $map[$sideLen+1][$sideLen*2+1+$i] = 'E';
  $map[$sideLen+1+$i][$sideLen] = 'F';
  $map[$sideLen+1+$i][$sideLen*2+1] = 'G';
  $map[$sideLen*2][$i] = 'H';
  $map[$sideLen*2+1+$i][0] = 'I';
  $map[$sideLen*2+1+$i][$sideLen*2+1] = 'J';
  $map[$sideLen*3+1][$sideLen+1+$i] = 'K';
  $map[$sideLen*3+1+$i][0] = 'L';
  $map[$sideLen*3+1+$i][$sideLen+1] = 'M';
  $map[$sideLen*4+1][$i+1] = 'N';
}
$map[$sideLen+1][$sideLen*2+1] = 'O';
$map[$sideLen*2][$sideLen] = 'P';
$map[$sideLen*3+1][$sideLen+1] = 'Q';

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
      $vOld = $v;
      $hOld = $h;
      $cDirOld = $cDir;
      $v += $dir[$cDir][0];
      $h += $dir[$cDir][1];
      switch ($map[$v][$h]) {
      case '.':
      case '#':
        break;
      case 'A':			// to L
        $cDir = 0;
        $v = $h+$sideLen*2;
        $h = 1;
        break;
      case 'B':			// to N
        $cDir = 3;
        $v = $sideLen*4;
        $h = $h-$sideLen*2;
        break;
      case 'C':			// to I
        $cDir = 0;
        $v = $sideLen*3-$v+1;
        $h = 1;
        break;
      case 'D':			// to J
        $cDir = 2;
        $v = $sideLen*3-$v+1;
        $h = $sideLen*2;
        break;
      case 'E':			// to G
        $cDir = 2;
        $v = $h-$sideLen;
        $h = $sideLen*2;
        break;
      case 'F':			// to H
        $cDir = 1;
        $h = $v-$sideLen;
        $v = $sideLen*2+1;
        break;
      case 'G':			// to E
        $cDir = 3;
        $h = $v+$sideLen;
        $v = $sideLen;
        break;
      case 'H':			// to F
        $cDir = 0;
        $v = $h+$sideLen;
        $h = $sideLen+1;
        break;
      case 'I':			// to C
        $cDir = 0;
        $v = $sideLen*3-$v+1;
        $h = $sideLen+1;
        break;
      case 'J':			// to D
        $cDir = 2;
        $v = $sideLen*3-$v+1;
        $h = $sideLen*3;
        break;
      case 'K':			// to M
        $cDir = 2;
        $v = $h+$sideLen*2;
        $h = $sideLen;
        break;
      case 'L':			// to A
        $cDir = 1;
        $h = $v-$sideLen*2;
        $v = 1;
        break;
      case 'M':			// to K
        $cDir = 3;
        $h = $v-$sideLen*2;
        $v = $sideLen*3;
        break;
      case 'N':			// to B
        $cDir = 1;
        $v = 1;
        $h = $h+$sideLen*2;
        break;
      case 'O':
        if ($cDir == 1) {
          $cDir = 2;
          $h--;
        }
        else {
          $cDir = 3;
          $v--;
        } 
        break;
      case 'P':
        if ($cDir == 2) {
          $cDir = 1;
          $v++;
        }
        else {
          $cDir = 0;
          $h++;
        } 
        break;
      case 'Q':
        if ($cDir == 1) {
          $cDir = 2;
          $h--;
        }
        else {
          $cDir = 3;
          $v--;
        } 
        break;
      default:
        echo 'Wrong char '.$map[$v][$h]." on v: $v h: $h";
        exit;
      }
      if ($map[$v][$h] == '#') {
        $v = $vOld;
        $h = $hOld;
        $cDir = $cDirOld;
        break;
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
