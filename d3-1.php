<?php
$data = file_get_contents('data/d3-1.txt', true);

$values = explode("\n", $data);
$duplicates = [];

foreach ($values as $value) {
    preg_match('/#(\w+) @ (\w+),(\w+): (\w+)x(\w+)/', $value, $inches);

    //Only with PHP >= 7.0
    list(, , $fromTheLeft, $fromTheTop, $wide, $tall) = $inches;

    for ($row = $fromTheLeft; $row < ($wide + $fromTheLeft); $row++) {
        for ($col = $fromTheTop; $col < ($tall + $fromTheTop); $col++) {
            if (isset($arr[$row][$col])) {
                $duplicates[] = "$row-$col";
            }
            $arr[$row][$col] = true;
        }
    }
}

$numberOfUniqueDuplicate = count(array_unique($duplicates, SORT_REGULAR));

echo $numberOfUniqueDuplicate;