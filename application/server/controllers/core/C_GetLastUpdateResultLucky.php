<?php

require_once controller;

class C_GetLastUpdateResultLucky extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        if (!isset($_SESSION["username"])) {
            redirect(ASETS . "?r=" . $this->encript->encdata("main"));
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
            $j = $_POST["id"];
            $sql = $this->select("wheelgtime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $_POST["id"]));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $data = array(
                    "gameid" => $row["id"],
                    "stime" => $row["stime"],
                    "etime" => $row["etime"],
                    "cdate" => date("Y-m-d")
                );
                $sql = $this->select("wheelwiner", $_SESSION["db_1"]) . $this->where($data, "AND");
                $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
                if ($row = $result->fetch_assoc()) {
                    echo "<td>" . $j . "</td>";
                    echo "<td>" . $row["picked"] . "</td>";
                    echo "<td>" . $row["etime"] . "</td>";
                    echo "<td>" . $row["dload"] . "</td>";
                    echo "<td>" . $row["80per"] . "</td>";
                    
                    echo "<td><span class='btn btn-success btn-xs'>Result Decleared</span><br><br>"
                    . "<a href='#' class='btn btn-default btn-xs' onclick=\"return viewDataLucky('" . $j . "','#displayDraw','" . $row["id"] . "')\" >Set Result MUL<a></td>";
                } else {
                    echo $this->printMessage("Error on Draw Contact to Admin...", "danger");
                }
                //print_r($_POST);die;
                //die;
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
        return;
    }

    public function distory() {
        parent::distory();
        return;
    }

}
