<?php
$list = array (
    'aaa,bbb,ccc,dddd',
    '123,456,789',
    '"aaa","bbb"'
);

$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/MyGraid/file.csv', 'w');

foreach ($list as $line) {
    fputcsv($fp, split(',', $line));
}

fclose($fp);
print_r($list);
