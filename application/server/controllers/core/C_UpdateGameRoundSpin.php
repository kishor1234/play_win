<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once controller;
class C_UpdateGameRoundSpin extends CAaskController {

    //put your code here
    public function __construct() {
        parent::__construct();
        if(!isset($_SESSION["username"])){redirect(HOSTURL);}
    }

    public function create() {
        parent::create();
        
        return;
    }

    public function initialize() {
        parent::initialize();
       
        return;
    }

    public function execute() {
        parent::execute();
        try{
            $sql = $this->select("wheelgtime", $_SESSION["db_1"]) . $this->whereSinglelessthanequal(array("stime" => date("H:i:s"))) . $this->orderBy("DESC", "id") . $this->limitWithOutOffset(1);
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $_SESSION["gameidspin"] = $row["id"];
                $_SESSION["stimespin"] = $row["stime"];
                $_SESSION["etimespin"] = $row["etime"];
                $row["time"]=  (int)strtotime($row["etime"])-(int)strtotime(date("H:i:s"));
                echo json_encode($row);
                
            }
        } catch (Exception $ex) {

        }
       //echo '{ "time": "120" }';
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

   
}
