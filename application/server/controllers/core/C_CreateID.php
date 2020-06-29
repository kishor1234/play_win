<?php

require_once controller;

class C_CreateID extends CAaskController {

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
            //echo $this->insert("enduser", $_SESSION["db_1"], $_POST);
            $this->adminDB[$_SESSION["db_1"]]->query($this->insert("enduser", $_SESSION["db_1"], $_POST)) != 1 ? array_push($error, "Account Not Create") : true;
            $id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
            if ($id > 25) {
                array_push($error, "You Enter Only 1 id, try update limit...!");
            }
            $userid = 10000 + (int) $id;
            $this->adminDB[$_SESSION["db_1"]]->query($this->adminDB[$_SESSION["db_1"]]->query($this->update(array("userid" => $userid), "enduser") . $this->whereSingle(array("id" => $id)))) ? array_push($error, "Error on update...") : true;
            if (empty($error)) {
                $this->adminDB[$_SESSION["db_1"]]->commit();
                //print_r($error);
                echo $_SESSION["db_1"] = $this->printMessage("Thanks for creating id #" . $userid, "success");
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
