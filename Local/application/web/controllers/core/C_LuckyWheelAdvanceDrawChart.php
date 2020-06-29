<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once controller;

class C_LuckyWheelAdvanceDrawChart extends CAaskController {

    //put your code here
    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["username"])) {
            redirect(HOSTURL);
        }
    }

    public function create() {
        parent::create();

        return;
    }

    public function initialize() {
        parent::initialize();

        return;
    }

    public function execute() {
        parent::execute();
        try {
            $this->isLoadView("VLuckyWheelAdvanceDrawList", false, array());
        } catch (Exception $ex) {
            
        }
        //echo '{ "time": "120" }';
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
