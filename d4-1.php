<?php
$data = file_get_contents('data/d4-1.txt', true);

$values = explode("\n", $data);

foreach ($values as $value) {
//    [1518-11-13 00:04] Guard #2411 begins shift
//    [1518-09-18 00:43] wakes up
    preg_match('/.(\w+)-(\w+)-(\w+) (\w+):(\w+). (.+)$/', $value, $date);
    $day = $date[2];
    $month = $date[3];
    $hour = $date[4];
    $minute = $date[5];
    $text = $date[6];

    echo "FIRST: $day , $month , $hour , $minute , $text\n";
    die;
}

$numberOfUniqueDuplicate = count(array_unique($duplicates, SORT_REGULAR));

echo $numberOfUniqueDuplicate;