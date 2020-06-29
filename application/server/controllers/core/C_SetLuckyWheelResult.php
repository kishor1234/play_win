<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_SetLuckyWheelResult extends CAaskController {

    //put your code herews
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();

        return;
    }

    public function initialize() {
        parent::initialize();
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("status" => "0"), "wheelgtime"));
        $t = 1;
        if ($t === 0) {
            $_POST["gameid"] = "7";
            $_POST["stime"] = "10:33:00";
            $_POST["etime"] = "10:38:00";
        }
        if (isset($_REQUEST["t"])) {
            $t = (int) $_REQUEST["t"];

            if ($t === 0) {
                $sql = $this->select("wheelgtime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $_POST["id"]));
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

    function getLoad($per) {
        $sum = $this->getData($this->selectSum("wheelw", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
        echo $sum . "=Sum<br>";
        $_POST["dload"] = $sum;
        $avg = (($sum * $per) / 100);
        $_POST["80per"] = $avg;
        echo $avg . "=AvgP<br>";
        $damt = $avg / 9;
        echo $damt . "=Avg<br>";
        return $damt;
    }

    public function execute() {
        parent::execute();
        try {
            //$damt = $this->getLoad(80);
            $dper=80;
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("ws", $_SESSION["db_1"]));
            if ($row = $result->fetch_assoc()) {
                $dper=$row["id"];
            }
            $sum = $this->getData($this->selectSum("wheelw", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
            echo $sum . "=Sum<br>";
            $_POST["dload"] = $sum;
            $avg = (($sum * $dper) / 100);
            $_POST["80per"] = $avg;
            echo $avg . "=AvgP<br>";
            $damt = $avg / 9;
            echo $damt . "=Avg<br>";
            $result = $this->adminDB[$_SESSION["db_1"]]->query("SELECT `" . $_POST["gameid"] . "` FROM `wheelw`");
            $totalLoad = array();
            while ($row = $result->fetch_assoc()) {
                array_push($totalLoad, $row[$_POST["gameid"]]);
            }
            $_POST["loadarray"] = json_encode($totalLoad);
            $temp = array();
            $result = $this->adminDB[$_SESSION["db_1"]]->query("SELECT id,`" . $_POST["gameid"] . "` FROM `wheelw`");
            while ($row = $result->fetch_assoc()) {

                array_push($temp, $row[$_POST["gameid"]]);
            }
            echo "Temp <br>";
            print_r($temp);
            
           
            $l = count($temp) - 1;
            $rng = array(
                "0" => 1799,
                "1" => 1767,
                "2" => 1744,
                "3" => 1695,
                "4" => 1667,
                "5" => 1621,
                "6" => 1596,
                "7" => 1561,
                "8" => 1529,
                "9" => 1486
            );
            $_POST["rng"] = $rng[$_POST["picked"]];
            unset($_POST["id"]);
            $_POST["cdate"] = date("Y-m-d");
            //echo $this->insert("wheelwiner", $_SESSION["db_1"], $_POST);
            echo "<br>" . $_POST["picked"] . " Wamt" . ($temp[$_POST["picked"]] * 2) * 9 . " <br>";
            print_r($_POST);
            //die;
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("wheelwiner", $_SESSION["db_1"]) . $this->where(array("gameid" => $_POST["gameid"], "stime" => $_POST["stime"], "etime" => $_POST["etime"], "cdate" => date("Y-m-d")), "AND"));
            if ($r = $result->fetch_assoc()) {
                echo "already Result Disply";
            } else {
                echo $this->insert("wheelwiner", $_SESSION["db_1"], $_POST);
                $this->adminDB[$_SESSION["db_1"]]->query($this->insert("wheelwiner", $_SESSION["db_1"], $_POST));
                $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("weight" => 0), "wheelw"));
               
                $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("status" => "1"), "wheelgtime") . $this->whereSingle(array("id" => $_POST["gameid"])));
            }
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
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("`" . $_POST["gameid"] . "`" => 0), "wheelw"));
        return;
    }

    public function distory() {
        parent::distory();
        return;
    }

    function getArray() {
        $arr = array();

        for ($i = 0; $i < 10; $i++) {
            $arr[$i] = $i;
        }

        shuffle($arr);

        return $arr;
    }

}
