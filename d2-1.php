<?php

$data = file_get_contents('data/d2-1.txt', true);

$values = explode("\n", $data);
$twoLetters = $threeLetters = 0;

foreach ($values as $value) {
    if(hasTwoLetters($value)) {
        $twoLetters++;
    }
    if (hasThreeLetters($value)) {
        $threeLetters++;
    }
}

function hasTwoLetters($string) {
    foreach (count_chars($string, 1) as $i => $val) {
        if($val == 2) {
            return true;
        }
    }
    return false;
}

function hasThreeLetters($string) {
    foreach (count_chars($string, 1) as $val) {
        if($val == 3) {
            return true;
        }
    }
    return false;
}

echo $twoLetters * $threeLetters;