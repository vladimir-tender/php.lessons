<?php function valPercent($percent, $array){    $i = -1;    foreach ($array as $key => $value) {        $new_arr[] = $value + $value*$percent*$i;        $i = -1*$i;    }    return $new_arr;}function valPercent2($percent, $array){    foreach ($array as $key => $value) {        if ($key % 2 == 1)        {            $new_arr[] = $value - $value*$percent;        }        else        {            $new_arr[] = $value + $value*$percent;        }    }    return $new_arr;}//$arr_as = ["2" => 8, "1" => 4,"7" => 4, "3" => 4,"4" => 4, "5" => 4,"6" => 4, "8" => 4];//$arr = [4,2,5,1,3,87,3.5];//$arr_as = [2 => 8, 1 => 4,7 => 4, 3 => 4,4 => 4, 5 => 4,6 => 4, 8 => 4];$arr_as = [4.6,4.6,4.6,4.6,4.6,4.6,4.6];$new_arr = valPercent2(0.5,$arr_as);echo $arr_as[2]."_";var_dump($arr_as);var_dump($new_arr);