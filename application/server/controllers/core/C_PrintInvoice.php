<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_PrintInvoice extends CAaskController {

    //put your code here
    public $mainArray = array();

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();
        try {
            
            for ($i = 10; $i < 20; $i++) {
                if (!empty($_POST["sel_" . $i])) {
                    $select = $_POST["sel_" . $i];
                    $temp = array();
                    for ($j = 0; $j < 100; $j++) {
                        if (!empty($_POST["e_" . $select . "_" . $j])) {
                            $temp = array_merge($temp, array("e_" . $select . "_" . $j => $_POST["e_" . $select . "_" . $j]));
                            $qq = $this->updateINC(array("weight" => "weight+" . $_POST["e_" . $select . "_" . $j]), "lottoweight") . $this->whereSingle(array("number" => $j));
                            $this->adminDB[$_SESSION["db_1"]]->query($qq);
                        }
                    }
                    $t = array("totalqty" => $_POST['totalqty_' . $select], "totalamt" => $_POST['totalamt_' . $select]);
                    $temp = array_merge($temp, array("total" => $t));
                    array_push($this->mainArray, $temp);
                }
            }
            array_push($this->mainArray, array("tqty" => $_POST["tqty"], "tamt" => $_POST["tamt"]));
            $this->insertData($this->mainArray);
            $this->getLastNumber();
        } catch (Exception $ex) {
       }
        return;
    }

    public function initialize() {
        parent::initialize();
        return;
    }

    public function execute() {
        parent::execute();
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

    public function distory() {
        parent::distory();
        return;
    }

    function insertData($array) {
        $data = array("point" => json_encode($array), "amount" => $_POST["tamt"], "totalpoint" => $_POST["tqty"], "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $_SESSION["stime"], "gameendtime" => $_SESSION["etime"], "gametimeid" => $_SESSION["gameid"]);
        $this->adminDB[$_SESSION["db_1"]]->query($this->insert("entry", $_SESSION["db_1"], $data));
        //echo $this->insert("entry", $_SESSION["db_1"], $data);
    }

    function getLastNumber() {
        try {
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->selectMax("entry", "id"));
            $row = $result->fetch_assoc();
            $this->printInvoice($row["max(id)"]);
        } catch (Exception $ex) {
            
        }
    }

    function printInvoice($id) {
        try {
            $sql = $this->select("entry", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $id));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                echo "<h1>Lucky Four</h1>";
                echo "<h4>Date: " . $row["isDate"] . "</h4>";

                $this->pritnNumberData($row["point"]);
                echo"<br>";
                echo "Invoice: " . $id . "<br>";
                echo "<img src='AaskAPP/phpbarcode/Barcode_128.php?text=000" . $row["id"] . " alt='barcode'>";
            }
        } catch (Exception $ex) {
            
        }
    }

    function pritnNumberData($string) {

        echo "<table class=''><tr><th>Number</th><th>Qty</th><th>Number</th><th>Qty</th><th>Number</th><th>Qty</th></tr>";
        $data = json_decode($string);
        $optr = "<tr><strong>";
        $cltr = "</strong></tr>";
        $fl = 0;
        $tqty = 0;
        $tamt = 0;
        foreach ($data as $key => $value) {
            if ($fl == 0) {
                echo $optr;
            }
            foreach ($value as $k => $val) {

                if (strcmp($k, "total") != 0) {

                    if (strcmp($k, "tqty") != 0 && (strcmp($k, "tamt") != 0)) {
                        echo "<td>" . $k . "-</td><td>" . $val . "</td>";
                        $fl++;
                    } else {
                        if (strcmp($k, "tqty") == 0) {
                            $tqty = $val;
                        } else if (strcmp($k, "tamt") == 0) {
                            $tamt = $val;
                        }
                    }
                }
                if ($fl > 2) {
                    $fl = 0;
                    echo $cltr . $optr;
                }
            }
        }
        echo "</table>";
        echo "<table><tr><th>Tota Points</th><th>:</th><td>" . $tqty . "</td></table>";
        echo "<table><tr><th>Tota Points</th><th>:</th><td>" . $tamt . "</td></table>";
        echo "<strong>Per Ticket Price Rs. 2.00</strong>";
    }

}
