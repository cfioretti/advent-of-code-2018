<?php
$data = file_get_contents('data/d4-1.txt', true);

$values = explode("\n", $data);
$calendar = $calendarOfSleep = $calendarOfGuardAsleep = $hoursOfSleep = [];

extractInput($values, $calendar);
setHoursAndCalendarOfSleep($calendar, $guardId = 0, $calendarOfSleep, $hoursOfSleep);

$guardAsleep = findGuardWithTheMostMinutesAsleep($hoursOfSleep);
$calendarOfGuardAsleep = setCalendar($calendarOfSleep, $guardAsleep);
$minuteChoosed = asleepMostDuringMinute($calendarOfGuardAsleep);

$firstStrategy = $guardAsleep * $minuteChoosed;
echo $firstStrategy;
//result > 82324


function extractInput($values, &$calendar)
{
    foreach ($values as $value) {
        preg_match('/.(\w+)-(\w+)-(\w+) (\w+):(\w+). (.+)$/', $value, $date);
        list(, , $day, $month, $hour, $minute, $text) = $date;

        if ($hour > 0) {
            $minute = 0;
        }
        $calendar["$day/$month"][intval($minute)] = $text;
    }
}

function setHoursAndCalendarOfSleep($calendar, $guardId, &$calendarOfSleep, &$hoursOfSleep)
{
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

function setCalendar($calendarOfSleep, $guardAsleep)
{
    foreach ($calendarOfSleep as $key => $value) {
        if (strpos($key, "#$guardAsleep")) {
            $calendarGenerated[] = $value;
        }
    }
    return $calendarGenerated;
}

function asleepMostDuringMinute($arr)
{
    $out = array();
    foreach ($arr as $value) {
        foreach ($value as $value2) {
            if (array_key_exists($value2, $out)) {
                $out[$value2]++;
            } else {
                $out[$value2] = 1;
            }
        }
    }
    $result = array_keys($out, max($out));
    return $result[0];
}

function findGuardWithTheMostMinutesAsleep($arr)
{
    arsort($arr);
    $key_of_max = key($arr);
    return $key_of_max;
}