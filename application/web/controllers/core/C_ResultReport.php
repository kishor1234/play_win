<?php

require_once controller;
class C_ResultReport extends CAaskController {

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
            switch ($_POST["gameid"])
            {
                case "0":
                    $this->isLoadView("VLotoAllResult", FALSE, $_POST);
                    break;
                case "1":
                    $this->isLoadView("VLuckyWheelAllResult", FALSE, $_POST);
                    break;
                default :
                    
                    break;
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