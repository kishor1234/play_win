<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once controller;

class C_SetLotoResult extends CAaskController {

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
        
        
        
        return;
    }

    public function initialize() {
        parent::initialize();

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
            $dper=80;
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("ws", $_SESSION["db_1"]));
            if ($row = $result->fetch_assoc()) {
                $dper=$row["id"];
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
            $lottery=array();
            
            for($i=0;$i<10;$i++)
            {
                array_push($lottery, $_POST[$i]);
            }
           
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
            //$this->adminDB[$_SESSION["db_1"]]->query($this->update(array("status" => "1"), "gametime") . $this->whereSingle(array("id" => $_POST["gameid"])));
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

    function getArray() {
        $arr = array();

        for ($i = 0; $i < 100; $i++) {
            $arr[$i] = $i;
        }

        shuffle($arr);

        return $arr;
    }

}
