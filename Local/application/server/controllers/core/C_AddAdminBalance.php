<?php

require_once controller;

class C_AddAdminBalance extends CAaskController {

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
            $this->adminDB[$_SESSION['db_1']]->autocommit(FALSE);
            $error = array();
            $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("balance"=>"balance+".$this->filterPost("balance")), "user") . $this->whereSingle(array("id" => 1))) != 1 ? array_push($error, "Erro(001) Unable to Update Balance..") : true;
            $this->adminDB[$_SESSION["db_1"]]->query($this->insert("transaction", $_SESSION["db_1"], array("userid"=>$_SESSION["id"],"credit"=>$this->filterPost("balance"),"remark"=>"Self Credit form admin","ip"=>$_SERVER["REMOTE_ADDR"],"balance"=>$this->getData($this->select("user", $_SESSION["db_1"]).$this->whereSingle(array("id"=>$_SESSION["id"])), "balance"))))!=1? array_push($error, "Error on Transcation Table Error Code 02 "):true;
            if (empty($error)) {
                $this->adminDB[$_SESSION["db_1"]]->commit();
                echo $_SESSION["msg"] = $this->printMessage("UPDATE POINT'S SUCCESSFULLY ", "success");
            } else {
                $this->adminDB[$_SESSION["db_1"]]->rollback();
                echo $_SESSION["msg"] = $this->printMessage("ERROR ON UPDATE POINT'S " . $error[0], "danger");
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
