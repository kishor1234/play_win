<?php

require_once controller;

class C_UpdateID extends CAaskController {

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
            $_POST["ip"] = $_SERVER["REMOTE_ADDR"];
            $_POST["create_on"] = date("Y-m-d");
            $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
            $error = array();
            $data=array(
                "name"=>$_POST["name"],
                "mobileno"=>$_POST["mobileno"],
                "is_active"=>$_POST["is_active"]
            );
            print_r($_POST);
            //echo $this->insert("enduser", $_SESSION["db_1"], $_POST);
            $this->adminDB[$_SESSION["db_1"]]->query($this->update($data, "enduser").$this->whereSingle(array("userid"=>$_POST["userid"]))) != 1 ? array_push($error, "Account Not Updated") : true;
            $id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
            //$this->adminDB[$_SESSION["db_1"]]->query($this->adminDB[$_SESSION["db_1"]]->query($this->update(array("userid" => $userid), "enduser") . $this->whereSingle(array("id" => $id)))) ? array_push($error, "Error on update...") : true;
            if (empty($error)) {
                $this->adminDB[$_SESSION["db_1"]]->commit();
                //print_r($error);
                echo $_SESSION["db_1"] = $this->printMessage("Thanks for Update Success id #" . $_POST["userid"], "success");
            } else {
                $this->adminDB[$_SESSION["db_1"]]->rollback();
                echo $_SESSION["db_1"] = $this->printMessage("Unable to create ID ".  $error[0], "danger");
            }
        } catch (Exception $ex) {
            $this->adminDB[$_SESSION["db_1"]]->rollback();
            echo $_SESSION["db_1"] = $this->printMessage("Catch Unable to create ID", "danger");
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
