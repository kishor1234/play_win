<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_CancelTicket extends CAaskController {

    //put your code here
    public $amount = 0;
    public $sad;
    public $happy;
    public $fw;
    public $tpoint = 0;
    public $wnumber = 0;
    public $no;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();
        if (!isset($_SESSION["username"])) {
            redirect(ASETS . "?r=" . $this->encript->encdata("main"));
        }
        return;
    }

    public function initialize() {
        parent::initialize();
        $this->sad = "<img src='assets/img/sad.gif' style='height:100px;'>";
        $this->happy = "<img src='/assets/img/happyr.gif' style='height:100px;'>";
        $this->fw = "<img src='/assets/img/fw.gif' style='height:100px;'>";
        return;
    }

    public function execute() {
        parent::execute();
        try {

            $ss = explode("-", $this->filterPost("id"));
            $error = array();
            $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $ss[1], "enterydate" => date("Y-m-d"), "own" => $_SESSION["userid"]), "AND"));
            if ($row = $result->fetch_assoc()) {
               switch ($ss[0]) {
                        case 0:
                            $gametime = strtotime($row["gametime"]);
                            $cgametime = strtotime($_SESSION["stime"]);
                            if ($cgametime <= $gametime) {
                                $balance = (float) $row["amount"] - (float) ($row["amount"] * 5) / 100;
                                $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("balance" => "balance+" . $balance), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]))) != 1 ? array_push($error, "Update Balance Error") : true;
                                $data = json_decode($row["point"]);
                                $fl = 0;
                                $tqty = 0;
                                $tamt = 0;

                                foreach ($data as $key => $value) {

                                    foreach ($value as $k => $val) {

                                        if (strcmp($k, "total") != 0) {

                                            if (strcmp($k, "tqty") != 0 && (strcmp($k, "tamt") != 0)) {
                                                $s = explode("_", $k);
                                                $qq = $this->updateINC(array("`" . $row["gametimeid"] . "`" => "`" . $row["gametimeid"] . "`" . "-" . $val), "lottoweight") . $this->whereSingle(array("number" => sprintf("%02d", $s[2])));
                                                $this->adminDB[$_SESSION["db_1"]]->query($qq);
                                                $qq = $this->updateINC(array("`" . $row["gametimeid"] . "`" => "`" . $row["gametimeid"] . "`" . "-" . $val), "`" . $s[1] . "`") . $this->whereSingle(array("number" => sprintf("%02d", $s[2])));
                                                $this->adminDB[$_SESSION["db_1"]]->query($qq);
                                                $fl++;
                                            }
                                        }
                                    }
                                }
                            }
                            break;
                        case 1:
                            $gametime = strtotime($row["gametime"]);
                            $cgametime = strtotime($_SESSION["stimespin"]);
                            if ($cgametime <= $gametime) {
                                $balance = (float) $row["amount"] - (float) ($row["amount"] * 5) / 100;
                                $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("balance" => "balance+" . $balance), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]))) != 1 ? array_push($error, "Update Balance Error") : true;
                                $data = json_decode($row["point"]);
                                print_r($data);
                                $fl = 0;
                                $tqty = 0;
                                $tamt = 0;
                                foreach ($data as $key => $value) {

                                    foreach ($value as $k => $val) {

                                        if (strcmp($k, "total") != 0) {

                                            if (strcmp($k, "tqty") != 0 && (strcmp($k, "tamt") != 0)) {
                                                $s = explode("_", $k);
                                                //echo $this->updateINC(array("weight" => "weight-" . $val), "wheelw") . $this->whereSingle(array("id" => $s[1]));
                                                $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("`" . $row["gametimeid"] . "`" => "`" . $row["gametimeid"] . "`-" . $val), "wheelw") . $this->whereSingle(array("id" => $s[1])));

                                                $fl++;
                                            }
                                        }
                                    }
                                }
                            }


                            break;
                        default :
                    }


                    $this->adminDB[$_SESSION["db_1"]]->query($this->delete("entry") . $this->whereSingle(array("id" => $ss[1]))) != 1 ? array_push($error, "Unable to delte") : true;
                    $this->adminDB[$_SESSION["db_1"]]->query($this->delete("usertranscation") . $this->whereSingle(array("invoiceno" => $ss[1]))) != 1 ? array_push($error, "Unable to delte") : true;

                    if (empty($error)) {
                        echo $this->printMessage("Success..", "success");
                        $this->adminDB[$_SESSION["db_1"]]->commit();
                    } else {
                        echo $this->printMessage("Invalid Entry ", "danger");
                        $this->adminDB[$_SESSION["db_1"]]->rollback();
                    }
                
            } else {
                echo $this->printMessage("Invalid Barcode", "danger");
            }
        } catch (Exception $ex) {
            $this->adminDB[$_SESSION["db_1"]]->rollback();
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

    public function distory() {
        parent::distory();
        return;
    }

    function updateload($data) {
        
    }

}
