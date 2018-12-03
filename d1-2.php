<?php

$data = file_get_contents('data/d1-1.txt', true);

$values = explode("\n", $data);
$partial = 0;
$results = [];

do {
    foreach ($values as $value) {
        $partial += $value;
        if(in_array($partial , $results)) {
            break(2);
        }
        array_push($results, $partial);
    }
}
while (count($results) == count(array_unique($results)) );

echo $partial;