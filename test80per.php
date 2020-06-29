<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$arr = array();

for ($i=0;$i<100;$i++) {
    $arr[$i] = $i;
}

shuffle($arr);

print_r($arr);
die;
$data = array();
$sum = 0;
for ($i = 0; $i < 100; $i++) {
    $n = rand(0, 10);
    $data[$i] = $n;
    $sum = $sum + $n;
}
echo "Sum of Total=" . $sum . "<br>";
$per = ($sum * 80) / 100;
echo "Per=" . $per . "<br>";
$avgp = $per / 90;
echo "Amt Rels=" . $avgp . "<br>";
$avg = round($avgp / 10);
echo "Amt per D=" . $avg . "<br>";
$data1 = $data;
$tmp=array();
function quick($data) {
    $min = count($data);
    while ($mid != 0) {
        $t=count($data)/2;
        if($avg==$count[$t])
        {
            array_push($tmp, $t);
        }else{
            $tp=array();
            for($i=0;$i<$t;$i++)
            {
                $tp[$i]=$data[$i];
                quick($tp);
            }
            $t++;
            $tp=array();
            for($i=$t;$i<count($data);$i++)
            {
                $tp[$i]=$data[$i];
                quick($tp);
            }
        }
    }
}
print_r($tmp);

