<?php

$data = file_get_contents('data/d1-1.txt', true);

$values = explode("\n", $data);

echo array_sum($values);