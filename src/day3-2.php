<?php

include 'day3PuzzleInput.php';
$input = explode("\r\n", $s1);

$score = 0;

while ($l1=strlen($s1=next($input))) {
  $l2 = strlen($s2=next($input));
  $l3 = strlen($s3=next($input));
  for ($i=0; $i<$l1; $i++)
    for ($j=0; $j<$l2; $j++)
      for ($k=0; $k<$l3; $k++)
        if (($ch=$s1[$i]) == $s2[$j] and $ch == $s3[$k]) break 3;
  if (($chv=ord($ch)) > 96) $chv -= 58;
  $score += $chv - 38;
}

echo "Result: $score";

?>
