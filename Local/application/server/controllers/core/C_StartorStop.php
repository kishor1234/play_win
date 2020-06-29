<?php
require_once controller;

class C_StartorStop extends CAaskController {

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
            $this->adminDB[$_SESSION["db_1"]]->query($this->update($_POST, "ws"));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("ws", $_SESSION["db_1"]));
            $row = $result->fetch_assoc();
            if ((int) $row["rstatus"] == 0) {
                ?>
                <h1>Click Button to Start Result</h1>
                <button class="btn btn-success" onclick="ResultServices(1)"><i class="fa fa-star"></i> Start</button>
                <?php
            } else {
                ?>
                <h1>Click Button to Stop Result</h1>
                <button class="btn btn-danger" onclick="ResultServices(0)"><i class="fa fa-stop"></i> Stop</button>

                <?php
            }
        } catch (Exception $ex) {

            $_SESSION["msg"] = $this->printMessage("Catch Unable to create ID", "danger");
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
