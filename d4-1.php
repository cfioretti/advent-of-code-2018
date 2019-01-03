<?php
$data = file_get_contents('data/d4-1.txt', true);

$values = explode("\n", $data);
$calendar = $calendarOfSleep = $calendarOfGuardAsleep = $hoursOfSleep = [];
$guardId = 0;

foreach ($values as $value) {
    preg_match('/.(\w+)-(\w+)-(\w+) (\w+):(\w+). (.+)$/', $value, $date);
    $day = $date[2];
    $month = $date[3];
    $hour = $date[4];
    $minute = $date[5];
    $text = $date[6];

    if ($hour > 0) {
        $minute = 0;
    }
    $calendar["$day/$month"][intval($minute)] = $text;
}

foreach ($calendar as $day => $records) {
    ksort($records);
    foreach ($records as $minute => $record) {
        if (guardBeginsShift($record)) {
            $guardId = guardBeginsShift($record);
            if (!isset($hoursOfSleep[$guardId])) {
                $hoursOfSleep[$guardId] = 0;
            }
        } elseif (strpos($record, 'asleep')) {
            for ($x = $minute; $x < 60; $x++) {
                $calendarOfSleep["$day#$guardId"][intval($x)] = $x;
                $hoursOfSleep[$guardId]++;
            }
        } elseif (strpos($record, 'up')) {
            for ($x = $minute; $x < 60; $x++) {
                unset($calendarOfSleep["$day#$guardId"][intval($x)]);
                $hoursOfSleep[$guardId]--;
            }
        }
    }
}

$guardAsleep = findGuardWithTheMostMinutesAsleep($hoursOfSleep);
$calendarOfGuardAsleep = setCalendar($calendarOfSleep, $guardAsleep);

foreach ($calendarOfGuardAsleep as $minute) {
    var_dump($minute);
    die;
}

var_dump($calendarOfGuardAsleep);
die;


$count = array_count_values($calendar["$day/$month-$guardId"]);
var_dump($count);
die;


function setCalendar($calendarOfSleep , $guardAsleep) {
    foreach ($calendarOfSleep as $key => $value) {
        if(strpos($key, "#$guardAsleep")) {
            $calendarGenerated[] = $value;
        }
    }
    return $calendarGenerated;
}

function findGuardWithTheMostMinutesAsleep($arr) {
    arsort($arr);
    $key_of_max = key($arr);
    return $key_of_max;
}

function guardBeginsShift($text)
{
    if ($start = strpos($text, "#")) {
        $end = strpos($text, "begins") - 1;
        $guardId = trim(substr($text, $start + 1, ($end - $start)));
        return $guardId;
    } else
        return false;
}

$numberOfUniqueDuplicate = count(array_unique($duplicates, SORT_REGULAR));

echo $numberOfUniqueDuplicate;