<?php

include 'day13PuzzleInput.php';
$input = explode("\r\n", $s1);
$outArray = array(next($input), next($input));
next($input);
while ($s1=next($input)) {
  $outArray = insert($s1, $outArray);
  $outArray = insert(next($input), $outArray);
  next($input);
}
$extVal = array ('[[2]]', '[[6]]');
$outArray = insert($extVal[0], $outArray);
$outArray = insert($extVal[1], $outArray);

echo 'Result: ' . ((array_search($extVal[0], $outArray)+1) * (array_search($extVal[1], $outArray)+1));

function insert($saIn, $outArray) {
  $pos = 0;
  foreach ($outArray as $sa1) {
    if (comp(json_decode($saIn), json_decode($sa1)) < 0) break;
    $pos++;
  }
  return array_merge(array_slice($outArray, 0, $pos), array($saIn), array_slice($outArray, $pos));
}

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
