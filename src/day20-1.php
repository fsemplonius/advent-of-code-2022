<?php

include 'day20PuzzleInput.php';
$input = explode("\r\n", $s1);
$file = array ();
$tnum = 0;
while (($s1=next($input)) != 9999)
  $file[] = array($tnum++, $s1);
$fileSav = $file;

for ($i=0; $i<$tnum; $i++) {
  $pos = array_search($fileSav[$i], $file);
  if (($nShift=$file[$pos][1]) != 0) {
    unset($file[$pos]);
    $newPos = $pos + $nShift;
    while ($newPos < 0) {
      $newPos += $tnum - 1;
    }
    while ($newPos >= $tnum) {
      $newPos -= $tnum - 1;
    }
    if ($newPos == 0) {
      $newPos = $tnum - 1;
    }
    $file = array_merge(array_slice($file, 0, $newPos), array($fileSav[$i]), array_slice($file, $newPos));
  }
}

foreach ($file as $key=>$value)
  if ($value[1] == 0) break;

$n1 = $file[($key+1000)%$tnum][1];
$n2 = $file[($key+2000)%$tnum][1];
$n3 = $file[($key+3000)%$tnum][1];

echo 'Result: ' . ($n1+$n2+$n3);

?>
