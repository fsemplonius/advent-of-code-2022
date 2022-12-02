<?php

include 'day2PuzzleInput.php';
$input = explode("\r\n", $s1);

$score = 0;
$shapeScore = array('X'=>1, 'Y'=>2, 'Z'=>3);
// rock a x paper b y scissors c z
$outcomeScore = array (
	'A'=>array('X'=>3 , 'Y'=>6 , 'Z'=>0),
	'B'=>array('X'=>0 , 'Y'=>3 , 'Z'=>6),
	'C'=>array('X'=>6 , 'Y'=>0 , 'Z'=>3));

while ($s1=next($input)) {
  list ($abc, $xyz) = explode(' ', $s1);
  $score += $shapeScore[$xyz] + $outcomeScore[$abc][$xyz];
}

echo "Result: $score";

?>
