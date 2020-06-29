<?php

require_once controller;
class C_DisplayAdminBalance extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
         if(!isset($_SESSION["username"])){redirect(ASETS."?r=".$this->encript->encdata("main"));}
        return;
    }

    public function initialize() {
        parent::initialize();

        return;
    }

    public function execute() {
        parent::execute();
       try{
           $result=$this->adminDB[$_SESSION["db_1"]]->query($this->select("user", $_SESSION["db_1"]));
           $row=$result->fetch_assoc();
           echo $row['balance'];
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