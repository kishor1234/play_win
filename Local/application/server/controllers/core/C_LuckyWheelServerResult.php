<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_LuckyWheelServerResult extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
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
            $sum = $this->getData($this->selectSum("wheelw", "weight"), "sum(weight)");
            $avg = (($sum * 80) / 100) / 10;
            $avg = round($avg);
            $temp = array();
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("wheelw", $_SESSION["db_1"]) . $this->whereSinglelessthanequal(array("weight" => $avg)));
            while ($row = $result->fetch_assoc()) {

                array_push($temp, $row);
            }
            $l = count($temp) - 1;
            $r = rand(0, $l);
            $temp[$r]["id"];
            $_POST["picked"] = $temp[$r]["id"];
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
            $_POST["rng"]=$rng[$_POST["picked"]];
            

            $_POST["gameid"] = $_SESSION["gameidspin"];
            $_POST["stime"] = $_SESSION["stimespin"];
            $_POST["etime"] = $_SESSION["etimespin"];
            $_POST["cdate"] = date("Y-m-d");
            //echo $this->insert("wheelwiner", $_SESSION["db_1"], $_POST);
            $this->adminDB[$_SESSION["db_1"]]->query($this->insert("wheelwiner", $_SESSION["db_1"], $_POST));
            $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("weight"=>0), "wheelw"));
            
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
        $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("weight" => 0), "lottoweight"));
        return;
    }

    public function distory() {
        parent::distory();
        return;
    }

}
