<?php

include 'day18PuzzleInput.php';
$input = explode("\r\n", $s1);

$cubes = array ();
while ($s1 = next($input)) {
  list($x, $y, $z) = explode(',', $s1);
  $cubes[$x+1][$y+1][$z+1] = 'x';
}

//$size = 8;
$size = 23;

for ($i=0; $i<3; $i++) {
  for ($j=0; $j<=$size; $j++)
    for ($k=0; $k<=$size; $k++) {
      switch ($i) {
      case 0:
        $x = $x1 = $j;
        $y = $y1 = $k;
        $z = 0;
        $z1 = $size;
        break;
      case 1:
        $x = $x1 = $j;
        $y = 0;
        $y1 = $size;
        $z = $z1 = $k;
        break;
      case 2:
        $x = 0;
        $x1 = $size;
        $y = $y1 = $j;
        $z = $z1 = $k;
      }
      $cubes[$x][$y][$z] = '.';
      $cubes[$x1][$y1][$z1] = '.';
    }
}

$found = true;
while ($found) {
  $found = false;
  for ($x=1; $x<$size; $x++)
    for ($y=1; $y<$size; $y++)
      for ($z=1; $z<$size; $z++)
        foreach(array(array(1,0,0),array(-1,0,0),array(0,1,0),array(0,-1,0),array(0,0,1),array(0,0,-1)) as $sa1) {
          if (!$cubes[$x][$y][$z] and
              $cubes[$x+$sa1[0]][$y+$sa1[1]][$z+$sa1[2]] == '.') {
            $found = true;
            $cubes[$x][$y][$z] = '.';
            break;
          }
        }
}

$surfaces = 0;
for ($x=0; $x<=$size; $x++)
  for ($y=0; $y<=$size; $y++)
    for ($z=0; $z<=$size; $z++) {
      foreach(array(array(1,0,0),array(-1,0,0),array(0,1,0),array(0,-1,0),array(0,0,1),array(0,0,-1)) as $sa1) {
        if ($cubes[$x][$y][$z] == 'x' and
            $cubes[$x+$sa1[0]][$y+$sa1[1]][$z+$sa1[2]] == '.')
          $surfaces++;
      }
    }

echo 'Result: ' . $surfaces;

?>
