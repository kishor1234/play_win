<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once controller;

class C_GetLuckyNumbersapi extends CAaskController {

    //put your code here
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

        return;
    }

    public function execute() {
        parent::execute();
        try {
            //$_POST["gameid"] = "102";
            //$_POST["stime"] = "18:20:00";
            //$_POST["etime"] = "18:25:00";
            $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("status" => 1), "gametime") . $this->whereSingle(array("id" => $_POST["gameid"])));
            $sum = $this->getData($this->selectSum("lottoweight", "`" . $_POST["gameid"] . "`"), "sum(`" . $_POST["gameid"] . "`)");
            $point = (float) $sum * 2;
            echo "Total Points: " . $point . "<br>";
            $per = ((float) ($point * 80) / 100);
            echo "Per 80% " . $per . "<br>";
            $avg = (float) $point - $per;
            echo "Average : " . $avg . "<br>";
            $avg = $avg / 10;
            echo "Average/10 : " . $avg . "<br>";
            $avg = round($avg);
            echo "Average round : " . $avg . "<br>";
            echo $sql = "SELECT number,`" . $_POST["gameid"] . "` FROM lottoweight WHERE `" . $_POST["gameid"] . "`<='" . $avg . "'";
            //echo $sql = $this->select("lottoweight", $_SESSION["db_1"]) . $this->whereSinglelessthanequal(array("`".$_POST["gameid"]."`" => $avg));
            //die;
            //$sql="SELECT number,`102` FROM lottoweight WHERE `102`<='0'";
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $data1 = array();
            $flag = false;
            while ($row = $result->fetch_assoc()) {
                array_push($data1, $row["number"]);
                $flag = true;
            }
            echo "<br>Data form DataBase ...<br>";
            print_r($data1);

            if (!$flag) {
                echo "<br>Flag not true " . $flag . "<br>";
                for ($rk = 0; $rk < 100; $rk++) {
                    array_push($data1, $rk);
                }
            }
            $maxn = count($data1);
            $maxn--;
            echo "<br>Max id " . $maxn . "<br>";
            if ($maxn > 0 && $maxn < 100) {
                echo $maxn;
            } else {
                $maxn = 99;
            }
            $maxb = "10";
            $numbers = range(0, $maxn);
            shuffle($numbers);
            $loto = array_slice($numbers, 0, 10);
            $lottery = array();
            $p = 0;
            foreach ($loto as $k => $v) {

                $lottery = array_merge($lottery, array($p => $data1[$v]));
                $p++;
            }
            echo "<br>Lottery Result....<br>";
            print_r($lottery);
            echo "<br>";
            $data = array("gameid" => $_POST["gameid"], "gamestime" => $_POST["stime"], "gameetime" => $_POST["etime"], "gdate" => date("Y-m-d"));
            $d = array_merge($data, $lottery);
            $query = $this->select("winnumber", $_SESSION["db_1"]) . $this->where(array("gameid" => $_POST["gameid"], "gamestime" => $_POST["stime"], "gameetime" => $_POST["etime"],"gdate"=>date("Y-m-d")), "AND");
            $rp = $this->adminDB[$_SESSION["db_1"]]->query($query);
            if ($r = $rp->fetch_assoc()) {
                echo "already Result Disply";
            } else {
                $sql = $this->insert("winnumber", $_SESSION["db_1"], $d);
                $this->adminDB[$_SESSION["db_1"]]->query($sql);
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
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("`".$_POST["gameid"]."`"=>0), "lottoweight"));
        return;
    }

    public function distory() {
        parent::distory();
        return;
    }

}
