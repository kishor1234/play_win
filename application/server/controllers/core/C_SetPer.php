<?php

require_once controller;

class C_SetPer extends CAaskController {

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
			if($_POST["id"]>=50 && $_POST["id"]<100){
				$sql=$this->update($_POST, "ws");
            echo $_POST["id"];
            $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $_SESSION["msg"]=$this->printMessage("Success", 'success');
			}else{
				$_SESSION["msg"]=$this->printMessage("You can't set below 80 and greater 90 percentage", 'danger');
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
