<?php

include 'day17PuzzleInput.php';
$input = $s1 . 'x';
$II = 0;

$tower = array (array('#', '#', '#', '#', '#', '#', '#'));		// v,h

$rocks1 = array (
array (array(0,0), array(0,1), array(0,2), array(0,3)),			// minus
array (array(2,1), array(1,0), array(1,1), array(1,2), array(0,1)),	// plus
array (array(2,2), array(1,2), array(0,0), array(0,1), array(0,2)),	// J
array (array(0,0), array(1,0), array(2,0), array(3,0)),			// I
array (array(0,0), array(0,1), array(1,0), array(1,1)));			// dot

$shiftMax = array (3, 4, 4, 6, 5);

$top = 0;
$Nrock = -1;
$result = 0;
while ($Nrock++ <= (2022-2)) {
  $rock = $Nrock % 5;
  // place rock
  $drop = 4;
  $shift = 2;
  while (true) {					// drop
    $i = -1;
    while ($s1=$rocks1[$rock][++$i]) {	// check floor poss
      list ($h, $v) = $s1;
      if ($tower[$top+$drop+$h][$shift+$v]) break 2;	// hit floor
    }
    //
    if (($dir=$input[$II++]) == 'x') {
      $II = 1;
      $dir = $input[0];
    }
    $shiftOld = $shift;
    if ($dir == '<')
      $shift = max(0, --$shift);
    else
      $shift = min($shiftMax[$rock], ++$shift);
    //
    $i = -1;
    $drop--;
    while ($s1=$rocks1[$rock][++$i]) {	// check neighbor poss
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

  while ($s1=$rocks1[$rock][++$i]) {	// check drop poss
    list ($h, $v) = $s1;
    $maxH = max($maxH, ($h1=$top+$drop+1+$h));
    $tower[$top+$drop+1+$h][$shift+$v] = '#';
  }
  //
  $top = max($top, $maxH);
  //
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

echo "Result: $top" ;

?>
