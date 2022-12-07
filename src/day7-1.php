<?php

include 'day7PuzzleInput.php';
$input = explode("\r\n", $s1);
//
//
// dirNodes array ('name' => 'name', 'dir1' => 'node1', 'dir2' => 'node2',
//                 'up' => n1, 'files' => array ('filename1'=>size, 'filename2'=>size, ...)
//
$ip = $ic = 0;
$dirNodes[$ip++] = array('name' => '/', 'cont'=>array());

function readNext(&$input, &$s1, &$s2, &$s3) {
  list($s1, $s2, $s3) = explode(' ', next($input));
}

readNext($input, $s1, $s2, $s3);
do {
  if ("$s1$s2" == '$cd') {
    if ($s3 == '/') {
      $ic = 0;
    }
    elseif ($s3 == '..') {
      $ic = $dirNodes[$ic]['up'];
    }
    else {
      $ic = $dirNodes[$ic][$s3];
    }
    readNext($input, $s1, $s2, $s3);
  }
  elseif ("$s1$s2" == '$ls') {
    readNext($input, $s1, $s2, $s3);
    do {
      if ($s1 == 'dir') {
        $dirNodes[$ip] = array('name' => $s2, 'up' => $ic, 'files' => array());
        $dirNodes[$ic][$s2] = $ip++;
      }
      else {
        $dirNodes[$ic]['files'][$s2] = $s1;   // name => size
      }
      readNext($input, $s1, $s2, $s3);
      if ($s1 == 999999) break 2;
    } while ($s1 != '$');
  }
  else {
    echo "error: $s1 $s2 $s3";
    exit;
  }
} while (true);

function calcSize (&$dirNodes, $ipDir) {
  $totSize = 0;
  foreach ($dirNodes[$ipDir] as $subDir => $val) {
    switch ($subDir) {
    case 'files':
      foreach ($val as $file=>$size) {
        $totSize += $size;
      }
      break;
    case 'name':
    case 'cont':
    case 'size':
    case 'up':
      break;
    default:
      $totSize += calcSize($dirNodes, $val);
    }
  }
  return $dirNodes[$ipDir]['size'] = $totSize;
}

calcSize($dirNodes, 0);

$totalSize = 0;
foreach ($dirNodes as $dirNode)
  if ($dirNode['size'] <= 100000) $totSize += $dirNode['size'];

echo 'Result: ' . $totSize;

?>
