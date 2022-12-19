<?php

include 'day13PuzzleInput.php';
$input = explode("\r\n", $s1);

$result = $i = 0;
while ($s1=next($input)) {
  $i++;
  $s2 = next($input);
  if (comp(json_decode($s1), json_decode($s2)) < 0)
    $result += $i;
  next($input);
}
echo 'result '.$result."\n";

function comp($sa1, $sa2) {
  if (is_array($sa1)) {
    if (is_array($sa2))	{	// both array
      $i = 0;
      while (($s1=$sa1[$i]) !== null and ($s2=$sa2[$i]) !== null) {
        if (($a1=is_array($s1)) xor ($a2=is_array($s2))) {
          if (!$a1) $s1 = array($s1);
          if (!$a2) $s2 = array($s2);
        }
        if (($v=comp($s1,$s2)) != 0) {
          return $v;
        }
        $i++;
      }
      return count($sa1) - count($sa2);
    }
    else
      return comp($sa1[0], $sa2);
  }
  elseif (is_array($sa2))
    return comp($sa1, $sa2[0]);
  else 				// both int
    return $sa1 - $sa2;
}

?>
