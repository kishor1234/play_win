<?php

require_once controller;

class C_GetLastUpdateResult extends CAaskController {

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
            $sql = $this->select("gametime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $_POST["id"]));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $data = array(
                    "gameid" => $row["id"],
                    "gamestime" => $row["stime"],
                    "gameetime" => $row["etime"],
                    "gdate" => date("Y-m-d")
                );
                echo $sql = $this->select("winnumber", $_SESSION["db_1"]) . $this->where($data, "AND");
                $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
                if ($row = $result->fetch_assoc()) {
                    echo "<td><strong>" . $j . "</strong></td>";
                    for ($i = 0; $i < 10; $i++) {
                        echo "<td>" . sprintf("%02d", $row[$i]) . "</td>";
                    }
                    echo "<td>" . $row["dload"] * 2 . "</td>";
                    echo "<td>" . $row["80per"] * 2 . "</td>";
                    echo "<td><span class='btn btn-success btn-xs'>Result Decleared</span><br><br>"
                    . "<a href='#' class='btn btn-default btn-xs' onclick=\"return viewData('" . $j . "','#displayDraw','" . $row["id"] . "')\" >Set Result MUL<a></td>";
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
