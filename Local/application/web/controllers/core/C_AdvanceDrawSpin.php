<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once controller;

class C_AdvanceDrawSpin extends CAaskController {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["username"])) {
            redirect(HOSTURL);
        }
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
        try {
            //$s = explode("-", $this->filterPost("id"));
            $sql = $this->select("wheelgtime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id"))) . $this->orderBy("DESC", "id") . $this->limitWithOutOffset(1);
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $_SESSION["gameidspin"] = $row["id"];
                $_SESSION["stimespin"] = $row["stime"];
                $_SESSION["etimespin"] = $row["etime"];
                $row["time"] = (int) strtotime($row["etime"]) - (int) strtotime(date("H:i:s"));
                $row["msg"] = "<p style='color:green';>Success</p>";
                echo json_encode($row);
            } else {
                $row["id"] = $_SESSION["gameidspin"];
                $row["stime"] = $_SESSION["stimespain"];
                $row["etime"] = $_SESSION["etimespain"];
                $row["msg"] = "<p style='color:red';>Faild to Update Draw</p>";
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
