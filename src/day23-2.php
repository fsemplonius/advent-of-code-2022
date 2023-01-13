<?php

include 'day23PuzzleInput.php';
$input = explode("\r\n", $s1);

$crater = array ();
$strt = strlen($input[1]);
$dotLine = str_repeat('.', $strt);
for ($i=0; $i<=$strt; $i++)
  $crater[] = "$dotLine$dotLine$dotLine";
while ($s1 = next($input))
  $crater[] = "$dotLine$s1$dotLine";
for ($i=0; $i<=$strt; $i++)
  $crater[] = $crater[0];

$ignore = array ();
$nghbr = array(array(-1,-1), array(-1,0), array(-1,1), array(0,-1), array(0,1), array(1,-1), array(1,0), array(1,1));
$nswes = array (array (array(-1,-1), array(-1,0), array(-1,1)),
                array (array(1,1), array(1,0), array(1,-1)),
                array (array(1,-1), array(0,-1), array(-1,-1)),
                array (array(-1,1), array(0,1), array(1,1)));
$nsweDir = 0;

$rounds = 0;
while (true) {
  $rounds++;
  $toTreat = array ();
  for ($v=1; $v<count($crater)-1; $v++) {
    for ($h=1; $h<$strt*3-1; $h++) {
      if ($crater[$v][$h] == '#') {
        $found = false;
        foreach ($nghbr as $pos) {
          if ($crater[$v+$pos[0]][$h+$pos[1]] == '#') {
            $found = true;
            break;
          }
        }
        if ($found) 
          $toTreat[] = array($v, $h);
      }
    }
  }
  if (count($toTreat) == 0)
    break;
  $mark = array ();			// all places proposed
  $proposes = array (); 		// move from 0=>$v 1=>$h to 2->$v 3=$h
  foreach ($toTreat as $pos) {
    for ($i1=$nsweDir; $i1<$nsweDir+4; $i1++) {
      $i = $i1 % 4;
      $found = false;
      for ($j=0; $j<3; $j++) {
        if ($crater[$pos[0]+$nswes[$i][$j][0]][$pos[1]+$nswes[$i][$j][1]] == '#') {
          $found = true;
          break;
        }
      }
      if (!$found) 
        break;
    }
    if (!$found) {
      $proposes[] = array ($pos[0], $pos[1], $v1=$pos[0]+$nswes[$i][1][0], $h1=$pos[1]+$nswes[$i][1][1]);
      if ($mark[$v1][$h1] === 0) {
        $mark[$v1][$h1]++;
      }
      else {
        $mark[$v1][$h1] = 0;
      }
    }
  }
  foreach ($proposes as $propose) {
    if (!$mark[$propose[2]][$propose[3]]) {
      $crater[$propose[2]][$propose[3]] = '#';
      $crater[$propose[0]][$propose[1]] = '.';
    }
  }

  $nsweDir = ++$nsweDir % 4;
}

echo "Result: $rounds";

?>
