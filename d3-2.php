<?php
$data = file_get_contents('data/d3-1.txt', true);

$values = explode("\n", $data);
$partial = $overlap = [];

foreach ($values as $value) {
    preg_match('/#(\w+) @ (\w+),(\w+): (\w+)x(\w+)/', $value, $inches);
    list(, $idClaim, $fromTheLeft, $fromTheTop, $wide, $tall) = $inches;
    $unique = true;

    for ($row = $fromTheLeft; $row < ($wide + $fromTheLeft); $row++) {
        for ($col = $fromTheTop; $col < ($tall + $fromTheTop); $col++) {
            if (!isset($arr[$row][$col])) {
                $arr[$row][$col] = $idClaim;
            } else {
                $unique = false;
                $overlap[] = $arr[$row][$col];
            }
        }
    }
    if ($unique) {
        $partial[] = $idClaim;
    }
}

$result = array_diff(array_unique($partial), array_unique($overlap));

if (count($result) == 1) {
    print_r($result);
}