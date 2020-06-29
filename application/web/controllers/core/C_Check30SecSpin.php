<?php

require_once controller;

class C_Check30secSpin extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        
        return;
    }

    public function initialize() {
        parent::initialize();

        return;
    }

    public function execute() {
        parent::execute();
        $balance = $this->getData($this->select("wheelgtime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $_SESSION["gameidspin"])), "status");
        if($balance!=null)
        {
            echo $balance;
            die;
        }
        else{
            echo "0";
            die;
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
