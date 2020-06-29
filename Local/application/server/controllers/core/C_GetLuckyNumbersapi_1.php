<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once controller;

class C_GetLuckyNumbersapi_1 extends CAaskController {

    //put your code here
    public $visState = false;
    public $l = array();

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->vie("login.php");
        parent::create();
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("status" => "0"), "gametime"));

        $t = 1;
        if ($t === 0) {
            $_POST["gameid"] = "73";
            $_POST["stime"] = "16:00:00";
            $_POST["etime"] = "16:05:00";
        }
        if (isset($_REQUEST["t"])) {
            $t = (int) $_REQUEST["t"];

            if ($t === 0) {
                $sql = $this->select("gametime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $_POST["id"]));
                $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
                if ($row = $result->fetch_assoc()) {
                    $_POST["gameid"] = $row["id"];
                    $_POST["stime"] = $row["stime"];
                    $_POST["etime"] = $row["etime"];
                    //print_r($_POST);die;
                    //die;
                }
            }
        }
        return;
    }

    public function initialize() {
        parent::initialize();
        $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("ws", $_SESSION["db_1"]));
        $row = $result->fetch_assoc();
        if ((int) $row["rstatus"] == 0) {
            die;
        }
        return;
    }

    function getIndex($val2) {
        $i = 0;
        while ($i < 100) {
            $n = rand(0, count($val2) - 1);
            if ($this->checkKeypreset($val2[$n])) {

                return $n;
            }
            $i++;
        }
        return null;
    }

    function checkKeypreset($n) {
        $flag = true;

        foreach ($this->l as $key => $val) {
            if ($n == $val) {
                $flag = false;
            }
        }
        return $flag;
    }

    public function execute() {
        parent::execute();
        try {
            $sum = 0;
            $dper = 80;
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("ws", $_SESSION["db_1"]));
            if ($row = $result->fetch_assoc()) {
                $dper = $row["id"];
            }
            echo $dper;
            for ($i = 1000; $i < 2000; $i = $i + 100) {
                $sum+= $this->getData($this->selectSum("`" . $i . "`", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
            }
            echo $sum . "Load<br>";
            $load = array();
            for ($i = 1000; $i < 2000; $i = $i + 100) {
                $load[$i] = "";
            }
            for ($i = 1000; $i < 2000; $i = $i + 100) {
                $resutl = $this->adminDB[$_SESSION['db_1']]->query("SELECT `" . $_POST["gameid"] . "` FROM `" . $i . "` ORDER BY `number` ASC");
                $totalLoad = array();
                while ($row = $resutl->fetch_assoc()) {
                    array_push($totalLoad, $row[$_POST["gameid"]]);
                }
                $load[$i] = $totalLoad;
            }
            $load["lottoweight"] = "";
            $resutl = $this->adminDB[$_SESSION['db_1']]->query("SELECT `" . $_POST["gameid"] . "` FROM `lottoweight` ORDER BY `number` ASC");
            $totalLoad = array();
            while ($row = $resutl->fetch_assoc()) {
                array_push($totalLoad, $row[$_POST["gameid"]]);
            }
            $load["lottoweight"] = $totalLoad;
            $_POST["loadarray"] = json_encode($load);
            $sum = (float) $this->getData($this->selectSum("lottoweight", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
            $point = (float) $sum;
            $_POST["dload"] = $point;
            echo "Total Points: " . $point . "<br>";
            $per = ((float) ($point * $dper) / 100);
            echo "Per 80% " . $per . "<br>";
            $_POST["80per"] = $per;
            $damt = $per / 90;
            echo "<br> Damit: " . $damt . "</br>";
            $avgp = round($damt);
            echo "Average round : " . $avgp . "<br>";
            $avg = $avgp / 10;
            echo "Average per plat =" . $avg . "<br>";
            $wamt = (round($avgp) * 2) * 90;
            echo "Excepted Wingin amt  " . $wamt;
            //die;
            $load = array();
            for ($i = 1000; $i < 2000; $i = $i + 100) {
                $sum = $this->getData($this->selectSum("`" . $i . "`", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
                array_push($load, $sum);
            }

            if ($point <= 0) {
                $markResult = array();
                $sonaResult = array();
                $sks = 0;
                while ($sks < 10) {
                    $zeroload = array();
                    $nonzeroload = array();
                    foreach ($load as $key => $val) {
                        if ($val == 0) {
                            array_push($zeroload, $key);
                        } else {
                            array_push($nonzeroload, $key);
                        }
                    }
                    $countofzeroload = count($zeroload); //."<br>";
                    $countofnonzeroload = count($nonzeroload); //."<br>";
                    //print_r($load);die;
                    $lottery = array();
                    for ($i = 0; $i < 10; $i++) {
                        array_push($lottery, "null");
                    }
                    $_arrayAllNumberData = array();
                    $unicarrayIndex = array();
                    $unicarraylist = array();
                    for ($rk = 1000; $rk < 2000; $rk = $rk + 100) {
                        $arrayAllData = array();
                        $arrayAllDataNumber = array();
                        $sqlt = "SELECT number,`" . $_POST["gameid"] . "` FROM `" . $rk . "` ";
                        $result = $this->adminDB[$_SESSION["db_1"]]->query($sqlt);
                        while ($row = $result->fetch_assoc()) {
                            array_push($arrayAllData, $row[$_POST["gameid"]]);
                            array_push($arrayAllDataNumber, $row["number"]);
                        }
                        array_push($_arrayAllNumberData, array($rk => $arrayAllData));
                        $unicarray = array_unique($arrayAllData);
                        array_push($unicarraylist, array($rk => $unicarray));
                        $tparr = array();
                        foreach ($unicarray as $key => $val) {
                            $temp = array();
                            for ($i = 0; $i < count($arrayAllData); $i++) {
                                if ($arrayAllData[$i] == $val) {
                                    array_push($temp, $i);
                                }
                            }
                            array_push($tparr, array($val => $temp));
                        }
                        array_push($unicarrayIndex, array($rk => $tparr));
                    }
                    $i = 0;
                    $s = 0;
                    $sum = 0;
                    $avgt = $avg;
                    //print_r($zeroload);die;
                    //calculate Zero Load value
                    foreach ($zeroload as $k => $v) {
                        $val = $_arrayAllNumberData[$v];
                        foreach ($val as $key1 => $val1) {
                            $n = 0;
                            $r = 0;
                            $fl = false;
                            while ($r < count($val1) - 1) {
                                $n = rand(0, count($val1) - 1);
                                if ($val1[$n] <= $avg) {
                                    if (!in_array($n, $lottery)) {
                                        //array_push($this->l, $n);
                                        $lottery[$v] = $n;
                                        $i++;
                                        $s = $s + $val1[$n];
                                        if ($val1[$n] == 0) {
                                            $sum = $sum + $avg;
                                        }
                                        //$avg = $avg - $val1[$n];
                                        $fl = true;
                                        break;
                                    }
                                }
                                $r++;
                            }
                            if (!$fl) {
                                array_push($this->l, $n);
                            }
                        }
                    }
                    echo $countofnonzeroload . " // " . $countofzeroload . "<br>";
                    echo "Sum of Zero " . $sum . "<br>";
                    if ($countofnonzeroload != 0) {
                        $dt = round($sum / $countofnonzeroload); //."/".$avg."<br>";
                        //echo $sum."<br> ";
                        $avg = $avg + $dt;
                    }
                    $tavg = $avg;

                    $sona = 0;
                    $kish = 0;
                    //Calculate Non Zero Load Value
                    foreach ($nonzeroload as $k => $v) {
                        $val = $_arrayAllNumberData[$v];
                        foreach ($val as $key1 => $val1) {
                            $n = 0;
                            $r = 0;
                            $fl = false;
                            $x = $avg - rand(0, $avg);
                            if ($x < 0) {
                                $x = 0;
                            }
                            $t = $x;
                            $arr = $this->getArray();
                            foreach ($arr as $k => $n) {
                                //echo "New AVG " . $sona . "<br> && $val1[$n]";
                                $tsona = $sona + $val1[$n];
                                //echo "<br>Temp Sum ".$tsona."<br>";
                                if ($val1[$n] <= $avg && $val1[$n] >= $t && $tsona <= $avgp) {
                                    if (!in_array($n, $lottery)) {
                                        $lottery[$v] = $n;
                                        $sona = $sona + $val1[$n];
                                        $tp = $avg - $val1[$n];
                                        $avg = $tavg + $tp;
                                        // echo "<br>Set " . $v . " -- " . $val1[$n] . " " . $lottery[$v] . " <br>";
                                        $i++;
                                        $fl = true;
                                        break;
                                    }
                                } else if ($avg == 0) {
                                    $tsona = $sona + $val1[$n];
                                    if ($tsona <= $avgp) {
                                        if (!in_array($n, $lottery)) {
                                            $lottery[$v] = $n;
                                            $sona = $sona + $val1[$n];
                                            $tp = $avg - $val1[$n];
                                            $avg = $tavg + $tp;
                                            // echo "<br>Else Set " . $v . " -- " . $val1[$n] . " " . $lottery[$v] . " <br>";
                                            $i++;
                                            $fl = true;
                                            break;
                                        }
                                    }
                                }

                                $r++;
                            }
                            if ($fl == false && $sona <= $avgp) {
                                $min = min($val1);
                                $l = 0;

                                $arr = $this->getArray();
                                foreach ($arr as $k => $n) {
                                    if ($min == $val1[$n]) {
                                        if (!in_array($n, $lottery)) {
                                            $lottery[$v] = $n;
                                            $sona = $sona + $val1[$n];
                                            // echo "<br>False Add" . $v . "--" . $val1[$n] . "<br>";
                                            break;
                                        }
                                    }
                                    $l++;
                                }
                            }
                            foreach ($lottery as $key => $val) {
                                if (strcmp($val, "null") == 0) {
                                    $min = min($val1);
                                    $arr = $this->getArray();
                                    foreach ($arr as $k => $n) {
                                        if ($min == $val1[$n]) {
                                            if (!in_array($n, $lottery)) {
                                                $lottery[$key] = $n;
                                                $sona = $sona + $val1[$n];
                                                //echo "<br>False Add" . $v . "--" . $val1[$n] . "<br>";
                                                break;
                                            }
                                        }
                                        $i++;
                                    }
                                }
                            }
                        }
                    }
                    $wamt = ($sona * 2) * 90;
                    echo "<br>Sum of Draw Less 2000 =" . $sona . "=" . $wamt . "<br>";
                    print_r($lottery);
                    $sflag = true;
                    foreach ($lottery as $key => $val) {
                        //echo "<br>NULL Val ".$val."<br>";
                        if (strcmp($val, "null") == 0) {
                            $sflag = false;

                            break;
                        }
                    }
                    if ($sflag == true) {
                        array_push($sonaResult, $sona);
                        array_push($markResult, $lottery);
                    }
                    $sks++;
                }
                echo "<br>Final array</br>";
                $index = array_search(max($sonaResult), $sonaResult);
                $lottery = $markResult[$index];
                print_r($lottery);
                //die;
            } else {
                $markResult = array();
                $sonaResult = array();
                $sks = 0;
                $sonatrue = true;
                $sonatrue1 = false;
                while ($sks < 10) {

                    $sum = (float) $this->getData($this->selectSum("lottoweight", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
                    $point = (float) $sum;
                    $rk = $dper;

                    $_POST["dload"] = $point;
                    echo "Total Points: " . $point . "<br>";
                    $per = ((float) ($point * $rk) / 100);
                    echo "Per 80% " . $per . "<br>";
                    $_POST["80per"] = $per;
                    $damt = $per / 90;
                    echo "<br> Damit: " . $damt . "</br>";
                    $avgp = $damt;
                    echo "Average round : " . $avgp . "<br>";
                    $avg = $avgp / 10;
                    echo "Average per plat =" . $avg . "<br>";
                    $zeroload = array();
                    $nonzeroload = array();
                    if ($sonatrue) {
                        $sum = (float) $this->getData($this->selectSum("lottoweight", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
                        $point = (float) $sum;
                        $rk = $dper; //+$sks;

                        $_POST["dload"] = $point;
                        echo "Total Points: " . $point . "<br>";
                        $per = ((float) ($point * $rk) / 100);
                        echo "Per 80% " . $per . "<br>";
                        $_POST["80per"] = $per;
                        $damt = $per / 90;
                        if ($sonatrue1) {
                            echo "<br> Damit: " . $damt . "</br>";
                            $avgp = $damt;
                            echo "Average round : " . $avgp . "<br>";
                            $avg = $avgp / 10;
                        } else {
                            echo "<br> Damit: " . $damt . "</br>";
                            $avgp = round($damt);
                            echo "Average round : " . $avgp . "<br>";
                            $avg = ceil($avgp / 10);
                        }

                        echo "Average per plat =" . $avg . "<br>";
                        $zeroload = array();
                        $nonzeroload = array();
                    } else {
                        $sum = (float) $this->getData($this->selectSum("lottoweight", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
                        $point = (float) $sum;
                        $rk = $dper; //+$sks;

                        $_POST["dload"] = $point;
                        echo "Total Points: " . $point . "<br>";
                        $per = ((float) ($point * $rk) / 100);
                        echo "Per 80% " . $per . "<br>";
                        $_POST["80per"] = $per;
                        $damt = $per / 90;

                        if ($sonatrue1) {
                            echo "<br> Damit: " . $damt . "</br>";
                            $avgp = round($damt);
                            echo "Average round : " . $avgp . "<br>";
                            $avg = round($avgp / 10);
                        } else {
                            echo "<br> Damit: " . $damt . "</br>";
                            $avgp = ceil($damt);
                            echo "Average round : " . $avgp . "<br>";
                            $avg = ceil($avgp / 10);
                        }

                        echo "Average per plat =" . $avg . "<br>";
                        $zeroload = array();
                        $nonzeroload = array();
                    }
                    foreach ($load as $key => $val) {
                        if ($val == 0) {
                            array_push($zeroload, $key);
                        } else {
                            array_push($nonzeroload, $key);
                        }
                    }
                    $countofzeroload = count($zeroload); //."<br>";
                    $countofnonzeroload = count($nonzeroload); //."<br>";

                    $lottery = array();
                    for ($i = 0; $i < 10; $i++) {
                        array_push($lottery, "null");
                    }
                    $_arrayAllNumberData = array();
                    $unicarrayIndex = array();
                    $unicarraylist = array();
                    for ($rk = 1000; $rk < 2000; $rk = $rk + 100) {
                        $arrayAllData = array();
                        $arrayAllDataNumber = array();
                        $sqlt = "SELECT number,`" . $_POST["gameid"] . "` FROM `" . $rk . "` ";
                        $result = $this->adminDB[$_SESSION["db_1"]]->query($sqlt);
                        while ($row = $result->fetch_assoc()) {
                            array_push($arrayAllData, $row[$_POST["gameid"]]);
                            array_push($arrayAllDataNumber, $row["number"]);
                        }
                        array_push($_arrayAllNumberData, array($rk => $arrayAllData));
                        $unicarray = array_unique($arrayAllData);
                        array_push($unicarraylist, array($rk => $unicarray));
                        $tparr = array();
                        foreach ($unicarray as $key => $val) {
                            $temp = array();
                            for ($i = 0; $i < count($arrayAllData); $i++) {
                                if ($arrayAllData[$i] == $val) {
                                    array_push($temp, $i);
                                }
                            }
                            array_push($tparr, array($val => $temp));
                        }
                        array_push($unicarrayIndex, array($rk => $tparr));
                    }
                    $i = 0;
                    $s = 0;
                    $sum = 0;
                    $avgt = $avg;
                    //print_r($zeroload);die;
                    //Calculate Greter than 2k Zero Load Value
                    foreach ($zeroload as $k => $v) {
                        $val = $_arrayAllNumberData[$v];
                        foreach ($val as $key1 => $val1) {
                            $n = 0;
                            $r = 0;
                            $fl = false;
                            while ($r < count($val1) - 1) {
                                $n = rand(0, count($val1) - 1);
                                if ($val1[$n] <= $avg) {
                                    if (!in_array($n, $lottery)) {
                                        //array_push($this->l, $n);
                                        $lottery[$v] = $n;
                                        $i++;
                                        $s = $s + $val1[$n];
                                        if ($val1[$n] == 0) {
                                            $sum = $sum + $avg;
                                        }
                                        //$avg = $avg - $val1[$n];
                                        $fl = true;
                                        break;
                                    }
                                }
                                $r++;
                            }
                        }
                    }
                    //echo $countofnonzeroload . " // " . $countofzeroload . "<br>";
                    //echo "Sum of Zero " . $sum . "<br>";
                    if ($countofnonzeroload != 0) {
                        $dt = round($sum / $countofnonzeroload); //."/".$avg."<br>";
                        //echo $sum."<br> ";
                        $avg = $avg + $dt;
                    }
                    $tavg = $avg;

                    $sona = 0;
                    $kish = 0;
                    $tsona = 0;
                    //Calculate Greater than 2k non zero load value
                    $arr = $this->getArray();

                    foreach ($nonzeroload as $k => $v) {
                        $val = $_arrayAllNumberData[$v];
                        foreach ($val as $key1 => $val1) {
                            $n = 0;
                            $r = 0;
                            $fl = false;
                            $x = $avg - rand(0, $avg);
                            if ($x < 0) {
                                $x = 0;
                            }
                            $t = $x; //$avg - rand(0, $avg);
                            $val2 = $this->paddZeor($val1, $avgp);
                            foreach ($arr as $k => $n) {
                                // echo "New AVG " . $n . "<br>";// && $val1[$n] >= $t";
                                $tsona = $sona + $val1[$n];
                                if ($val1[$n] <= $avg && $tsona <= $avgp) {
                                    if (!in_array($n, $lottery)) {
                                        $lottery[$v] = $n;
                                        // echo "<br>Add ".$val1[$n]."/".$tsona."/".$sona."/".$avgp."<br>";
                                        //echo "<br>Updated Avg " . $key1 . "/" . $avg . "<br>";
                                        $sona = $sona + $val1[$n];
                                        $tp = $avg - $val1[$n];
                                        $avg = $tavg + $tp;

                                        $i++;
                                        $fl = true;
                                        break;
                                    }
                                } else if ($val2[$n] <= $avgp) {
                                    $avg = $avg + $avg;
                                }
                                $r++;
                            }
                            if ($fl == false && $sona <= $avgp) {
                                $min = min($val1);
                                $n = 0;
                                // $arr = $this->getArray();
                                foreach ($arr as $k => $n) {
                                    // $n = rand(0, 99);
                                    if ($min == $val1[$n]) {
                                        if (!in_array($n, $lottery)) {
                                            $lottery[$v] = $n;
                                            $sona = $sona + $val1[$n];
                                            //echo "<br>False Add" . $v . "--" . $val1[$n] . "<br>";
                                            break;
                                        }
                                    }
                                    $i++;
                                }
                            }
                            // echo "<br>NULL eNTER CHCECK<br>";
                            /* foreach ($lottery as $key => $val) {
                              if (strcmp($val, "null") == 0) {
                              while ($i < 1000) {
                              $n = rand(0, 99);
                              $min = min($val1);
                              if ($val1[$n] <= $min) {
                              if (!in_array($n, $lottery)) {
                              $lottery[$key] = $n;
                              $sona = $sona + $val1[$n];
                              //echo "<br>False Add" . $v . "--" . $val1[$n] . "<br>";
                              break;
                              }
                              }
                              $i++;
                              }
                              }
                              } */
                        }
                    }
                    //$wamt = ($sona * 2) * 90;
                    //echo "<br>" . $sks . " Sum of Draw Greate 2000 " . $sona . "=" . $wamt . "<br>";
                    // print_r($lottery);
                    $sflag = true;
                    foreach ($lottery as $key => $val) {
                        //echo "<br>NULL Val ".$val."<br>";
                        if (strcmp($val, "null") == 0) {
                            $sflag = false;

                            break;
                        }
                    }
                    if ($sflag == true) {
                        array_push($sonaResult, $sona);
                        array_push($markResult, $lottery);
                        $wamt = ($sona * 2) * 90;
                        echo "<br>" . $sks . "<strong> Sum of Draw Greate 2000 " . $sona . "=" . $wamt . "</strong><br>";
                        print_r($lottery);
                        $sks++;
                    }

                    if ($sonatrue) {
                        $sonatrue = false;
                        $sonatrue1 = true;
                    } else {
                        $sonatrue = true;
                        $sonatrue1 = false;
                    }
                }
                echo "<br>Final array " . $avgp . "</br>";
                switch ($dper) {
                    case "60":
                        $index = array_search(max($sonaResult), $sonaResult);
                        $lottery = $markResult[$index];

                        break;
                    case "70":
                        $index = array_search(max($sonaResult), $sonaResult);
                        $lottery = $markResult[$index];
                    case "80":
                        $index = array_search(max($sonaResult), $sonaResult);
                        $lottery = $markResult[$index];
                        break;
                    default:
                        $index = array_search(max($sonaResult), $sonaResult);
                        $lottery = $markResult[$index];
                        break;
                }



                print_r($lottery);
                echo "<br>";
                //print_r($_POST);
                //die;
            }
            //die;
            //end new

            $data = array("gameid" => $_POST["gameid"], "gamestime" => $_POST["stime"], "gameetime" => $_POST["etime"], "gdate" => date("Y-m-d"), "dload" => $_POST["dload"], "80per" => $_POST["80per"], "loadarray" => $_POST["loadarray"]);
            $d = array_merge($data, $lottery);

            $query = $this->select("winnumber", $_SESSION["db_1"]) . $this->where(array("gameid" => $_POST["gameid"], "gamestime" => $_POST["stime"], "gameetime" => $_POST["etime"], "gdate" => date("Y-m-d")), "AND");
            $rp = $this->adminDB[$_SESSION["db_1"]]->query($query);
            if ($r = $rp->fetch_assoc()) {
                echo "already Result Disply"; //$this->ResetDrawLoad();
            } else {
                $sql = $this->insert("winnumber", $_SESSION["db_1"], $d);
                $this->adminDB[$_SESSION["db_1"]]->query($sql);
                $this->ResetDrawLoad();
            }
            $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("status" => "1"), "gametime") . $this->whereSingle(array("id" => $_POST["gameid"])));
        } catch (Exception $ex) {
            
        }
        return;
    }

    public function finalize() {
        parent::finalize();
        return;
    }

    public function reader() {
        parent::reader();

        return;
    }

    function ResetDrawLoad() {
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("`" . $_POST["gameid"] . "`" => 0), "lottoweight"));
        for ($i = 1000; $i < 2000; $i = $i + 100) {
            $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("`" . $_POST["gameid"] . "`" => 0), "`" . $i . "`"));
        }
    }

    public function distory() {
        parent::distory();
        return;
    }

    function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    function discard($unicarray, $arr) {
        foreach ($unicarray as $key => $val) {
            
        }
    }

    function paddZeor($val, $s) {
        $s = $s * 1000;
        for ($i = 0; $i < 100; $i++) {
            if ((int) $val[$i] == 0) {
                $val[$i] = $s;
            }
        }
        return $val;
    }

    function getArray() {
        $arr = array();

        for ($i = 0; $i < 100; $i++) {
            $arr[$i] = $i;
        }

        shuffle($arr);

        return $arr;
    }

}
