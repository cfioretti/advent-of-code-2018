<?php
$data = file_get_contents('data/d3-1.txt', true);

$values = explode("\n", $data);
$result = 0;

foreach ($values as $value) {
    preg_match('/#(\w+) @ (\w+),(\w+): (\w+)x(\w+)/', $value, $inches);
    $unique = true;
    $idClaim = $inches[1];
    $fromTheLeft = $inches[2];
    $fromTheTop = $inches[3];
    $wide = $inches[4];
    $tall = $inches[5];

    for ($row = $fromTheLeft; $row < ($wide + $fromTheLeft); $row++) {
        for ($col = $fromTheTop; $col < ($tall + $fromTheTop); $col++) {
            if (!isset($arr[$row][$col])) {
                $arr[$row][$col] = true;
            } else {
                $unique = false;
            }
        }
    }

    if ($unique) {
        $result = $idClaim;
    }
}

if ($result > 0) {
    echo $result;
}