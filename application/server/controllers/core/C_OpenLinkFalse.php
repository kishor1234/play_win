<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once controller;
class C_OpenLinkFalse extends CAaskController {

    //put your code here
    public function __construct() {
        parent::__construct();
        
    }

    public function create() {
        parent::create();
        if(!isset($_SESSION["username"])){redirect(HOSTURL);}
        return;
    }

    public function initialize() {
        parent::initialize();
       
        return;
    }

    public function execute() {
        parent::execute();
        switch($_REQUEST["tk"]){
            case 1:
                $this->isLoadView($this->encript->decdata($_REQUEST["v"]), true, array());
                break;
            default :
                $this->isLoadView($this->encript->decdata($_REQUEST["v"]), false, array());
                break;
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
    function checkRequest($key)
    {
        if(!isset($_REQUEST[$key]))
        {
            throw  new Exception($this->printMessage("Invalid Request...!", "danger"));
        }
    }
   
}
