<?php

if(basename($_SERVER["PHP_SELF"]) == "functions.php"){
    die("Error!!");
}

function getBlogEntryBody($buf) {
    $buf = substr($buf, strpos($buf, '</head>'));
    $res = '';
    $max = 0;
    $match = preg_split("'(<td[^>]*?>)|(</td>)|(<div[^>]*?>)|(</div>)'i", $buf, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($match as $val) {
        $cnt = 0;
        //$val = trim(strip_tags($val));

        $cnt = $cnt + substr_count($val, "、");
        $cnt = $cnt + substr_count($val, "。");
        $cnt = $cnt + substr_count($val, "！");
        $cnt = $cnt + substr_count($val, "？");

        if ($max < $cnt) {
            $max = $cnt;
            $res = $val;
        }
    }
    return $res;
}

function getBlogEntryBodyNT($buf) {
    $buf = substr($buf, strpos($buf, '</head>'));
    $res = '';
    $max = 0;
    $match = preg_split("'(<td[^>]*?>)|(</td>)|(<div[^>]*?>)|(</div>)'i", $buf, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($match as $val) {
        $cnt = 0;
        $val = trim(strip_tags($val));

        $cnt = $cnt + substr_count($val, "、");
        $cnt = $cnt + substr_count($val, "。");
        $cnt = $cnt + substr_count($val, "！");
        $cnt = $cnt + substr_count($val, "？");

        if ($max < $cnt) {
            $max = $cnt;
            $res = $val;
        }
    }
    return $res;
}