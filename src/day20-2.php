<?php

include 'day20PuzzleInput.php';
$input = explode("\r\n", $s1);
$file = array ();
$fileOrg = array(9999);
while (($s1=next($input)) != 9999)
  $fileOrg[] = $s1;
$tnum = count($fileOrg) - 1;
$fileOrg[] = 9999;

$i = 0;
$file = array();
$s881 = gmp_init("811589153");
while (($s1=next($fileOrg)) != 9999) {
  $s2 = gmp_div_qr(gmp_mul($s1, $s881), $tnum-1);
  $file[] = $s3 = array($i++, (int) $s2[1]);
  if ($s1 == 0) $key0 = $s3;
}

$fileSav = $file;

for ($j=0; $j<10; $j++) {
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
}

$key = array_search($key0, $file);

$n1 = $fileOrg[$file[(($key+1000)%$tnum)][0]+1];
$n2 = $fileOrg[$file[(($key+2000)%$tnum)][0]+1];
$n3 = $fileOrg[$file[(($key+3000)%$tnum)][0]+1];

echo 'Result: ' . gmp_strval(gmp_mul($n1+$n2+$n3, $s881));

?>
