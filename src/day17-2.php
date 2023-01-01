<?php

include 'day17PuzzleInput.php';
$input = $s1 . 'x';
$II = 0;

$tower = array (array('#', '#', '#', '#', '#', '#', '#'));		// v,h

$numRocks = gmp_init('1000000000000');

$rocks1 = array (
array (array(0,0), array(0,1), array(0,2), array(0,3)),			// minus
array (array(2,1), array(1,0), array(1,1), array(1,2), array(0,1)),	// plus
array (array(2,2), array(1,2), array(0,0), array(0,1), array(0,2)),	// J
array (array(0,0), array(1,0), array(2,0), array(3,0)),			// I
array (array(0,0), array(0,1), array(1,0), array(1,1)));			// dot

$shiftMax = array (3, 4, 4, 6, 5);

$kk = 0;
$numStable = 4;
$top = $topExt = 0;
$rock = -1;
$Nrock = 0;
$NRocksRemaining = 100000;
$result = 0;
while (++$Nrock <= $NRocksRemaining) {
  $rock = ++$rock % 5;
  // place rock
  $drop = 4;
  $shift = 2;
  while (true) {					// drop
    $i = -1;
    while ($s1=$rocks1[$rock][++$i]) {	// check drop floor
      list ($h, $v) = $s1;
      if ($tower[$top+$drop+$h][$shift+$v]) break 2;	// hit floor
    }
    //
    if (($dir=$input[$II++]) == 'x') {
      $II = 1;
      $dir = $input[0];
      if ($numStable-- <= 0) {
        $nPass = gmp_div_qr(gmp_sub($numRocks, $Nrock), $Nrock - $lastNrock);
        $topExt = gmp_mul($nPass[0], $top - $lastTop);
        $NRocksRemaining = gmp_add($Nrock, $nPass[1]);
        $numStable = 10;			// prevent this executing again
      }
      else {
        $lastTop = $top;
        $lastNrock = $Nrock;
      }
    }
    $shiftOld = $shift;
    if ($dir == '<')
      $shift = max(0, --$shift);
    else
      $shift = min($shiftMax[$rock], ++$shift);
    //
    $i = -1;
    $drop--;
    while ($s1=$rocks1[$rock][++$i]) {	// check hit neighbor
      list ($h, $v) = $s1;
      if ($tower[$top+1+$drop+$h][$shift+$v]) {	// hit neighbor
        $shift = $shiftOld;
        break;
      }
    }
  }
  //
  $i = -1;
  $maxH = 0;
  while ($s1=$rocks1[$rock][++$i]) {	// mark pos
    list ($h, $v) = $s1;
    $maxH = max($maxH, ($h1=$top+$drop+1+$h));
    $tower[$top+$drop+1+$h][$shift+$v] = '#';
  }
  //
  $top = max($top, $maxH);
}

//prtTower($tower, 3100);

function prtTower($tower, $top) {
  for ($h=$top+4; $h>=0; $h--) { 
    for ($v=0; $v<7; $v++) {
      if (($ch=$tower[$h][$v]) != '#') $ch = '.';
      echo $ch;
    }
    echo "\n";
  }
}

echo 'Result: ' . gmp_strval(gmp_add($topExt, $top));

?>
