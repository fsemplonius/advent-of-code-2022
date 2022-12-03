<?php

include 'day3PuzzleInput.php';
$input = explode("\r\n", $s1);

$score = 0;

while ($s1=next($input)) {
  $sL = substr($s1, 0, $s2=strlen($s1)/2);
  $sR = substr($s1, $s2);
  for ($i=0; $i<$s2; $i++)
    for ($j=0; $j<$s2; $j++)
      if (($ch=$sL[$i]) == $sR[$j]) break 2;
  if (($chv=ord($ch)) > 96) $chv -= 58;
  $score += $chv - 38;
}

echo "Result: $score";

?>
