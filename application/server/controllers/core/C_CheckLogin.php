<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_CheckLogin extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        //if(!isset($_SESSION["username"])){redirect(ASETS."?r=".$this->encript->encdata("main"));}
        return;
    }

    public function initialize() {
        parent::initialize();

        return;
    }

    public function execute() {
        parent::execute();
        $id = (int) $this->getData($this->select("user", $_SESSION["db_1"]), "lsession");
        if ($id == (int) $_SESSION["sid"]) {
            echo 0;
        } else {
            $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("lsession" => 0), "user") . $this->whereSingle(array("id" => 1)));

            session_destroy();
            echo 1;
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
