<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once controller;

class C_GetLuckyNumbers extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        echo "Work...";die;
        if (!isset($_SESSION["username"])) {
            // redirect(ASETS . "?r=" . $this->encript->encdata("main"));
        }
        return;
    }

    public function initialize() {
        parent::initialize();

        return;
    }

    public function execute() {
        parent::execute();
        try {
            $sum=$this->getData($this->selectSum("lottoweight", "weight"), "sum(weight)");
            $per=((float)($sum*80)/100);
            $avg=  (float)$sum-$per;
            $avg=$avg/10;
            $avg=  round($avg);
            $sql = $this->select("lottoweight", $_SESSION["db_1"]) . $this->whereSinglelessthanequal(array("weight" => $avg));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $data1 = array();
            $flag = false;
            while ($row = $result->fetch_assoc()) {
                array_push($data1, $row["number"]);
                $flag = true;
            }
            //print_r($data1);
            if (!$flag) {
                for ($rk = 0; $rk < 100; $rk++) {
                    array_push($data1, $rk);
                }
            }
            $maxn = count($data1);
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
            $data = array("gameid" => $_SESSION["gameid"], "gamestime" => $_SESSION["stime"], "gameetime" => $_SESSION["etime"], "gdate" => date("Y-m-d"));
            $d = array_merge($data, $lottery);
            $sql = $this->insert("winnumber", $_SESSION["db_1"], $d);
            $this->adminDB[$_SESSION["db_1"]]->query($sql);
            echo "<strong></strong>Time Sloat: " . $_SESSION["stime"] . " to " . $_SESSION["etime"] . "<br><table><tr>";
            for ($i = 1; $i <= count($lottery); $i++) {
                echo "<td><span class='badge'>" . $lottery[$i - 1] . "</span></td>";
            }
            echo "</tr></table>";
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
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("weight"=>0), "lottoweight"));
        return;
    }

    public function distory() {
        parent::distory();
        return;
    }

}
