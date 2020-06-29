<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//die(APPLICATION);
//require_once getcwd() . '/' . APPLICATION . "/controllers/Crout.php";
require_once controller;
class main extends CAaskController {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();
        if(isset($_SESSION["username"])){redirect(ASETS."?r=".$this->encript->encdata("C_Dashboard1"));}
        return;
    }

    public function initialize() {
        parent::initialize();
        try{
            $result=$this->adminDB[$_SESSION["db_1"]]->query($this->select("message", $_SESSION["db_1"]).$this->whereSingle(array("on_date"=>date("Y-m-d"))));
            if($row=$result->fetch_assoc())
            {
                echo "<marquee><h1>".$row["msg"]."</h1></marquee>";
            }
            else{
                 $this->isLoadView("main", false, array());
            }
        } catch (Exception $ex) {

        }
       
        return;
    }

    public function execute() {
        //parent::execute();
        return;
    }

    public function finalize() {
        //parent::finalize();
        return;
    }

    public function reader() {
        //parent::reader();
        return;
    }

    public function distory() {
        //parent::distory();
        return;
    }

   
}
