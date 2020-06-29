<?php

require_once controller;

class C_DeleteMessage extends CAaskController {

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
            if (isset($_REQUEST["mid"])) {
                $i = $this->adminDB[$_SESSION["db_1"]]->query($this->delete("message").$this->whereSingle(array("id"=>$_REQUEST["mid"])));
                if ($i == 1) {
                    echo $_SESSION["msg"] = $this->printMessage("Message Delete Successfully", "success");
                } else {
                    echo $_SESSION["msg"] = $this->printMessage("Message Delete Faild", "danger");
                }
            }
            $this->isLoadView("VMsgTable", false, array());
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
