<?php

$data = file_get_contents('data/d2-1.txt', true);

$values = explode("\r", $data);

foreach ($values as $valueToCompare) {
    foreach ($values as $valueCompared) {
        if ($result = thereIsOnlyOneDifferenceBetween($valueToCompare, $valueCompared)) {
            break(2);
        }
    }
}

function thereIsOnlyOneDifferenceBetween($string1, $string2)
{
    $num = array_diff_assoc(preg_split('//', $string1, -1, PREG_SPLIT_NO_EMPTY), preg_split('//', $string2, -1, PREG_SPLIT_NO_EMPTY));
    if (count($num) == 1) {
        $position = array_keys($num);
        return substr($string1, 0, intval($position[0])) . substr($string1, intval($position[0]) + 1);
    }
    return false;
}

echo $result;