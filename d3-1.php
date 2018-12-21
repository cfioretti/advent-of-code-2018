<?php
// 45782 < x < 129950
$data = file_get_contents('data/d3-1.txt', true);

$values = explode("\n", $data);
$duplicates = [];
#1 @ 287,428: 27x20

foreach ($values as $value) {
    preg_match('/#(\w+) @ (\w+),(\w+): (\w+)x(\w+)/', $value, $inches);
    $fromTheLeft = $inches[2];
    $fromTheTop = $inches[3];
    $wide = $inches[4];
    $tall = $inches[5];

    for ($row = $fromTheLeft; $row <= ($wide + $fromTheLeft); $row++) {
        for ($col = $fromTheTop; $col <= ($tall + $fromTheTop); $col++) {
            if (isset($arr[$row][$col])) {
                $duplicates[] = "$row-$col";
            }
            $arr[$row][$col] = true;
        }
    }
}

$numberOfUniqueDuplicate = count(array_unique($duplicates, SORT_REGULAR));

echo $numberOfUniqueDuplicate;