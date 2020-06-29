<?php

require_once controller;

class C_CheckBalance extends CAaskController {

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
        $balance = $this->getData($this->select("enduser", $_SESSION["db_1"]) . $this->whereSingle(array("userid" => $_SESSION["userid"])), "balance");
        if (!empty($this->filterPost("ad"))) {
            $s = explode(",", $this->filterPost("ad"));
            $n=count($s)-1;
            
            $amt = $this->filterPost("amt") * $n;
            
            if ($balance <= $amt) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            if ($balance <= $this->filterPost("amt")) {
                echo 1;
            } else {
                echo 0;
            }
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
