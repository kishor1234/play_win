<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;
class C_ChangePassword extends CAaskController {

    //put your code here
    public $visState = false;
    public $op;
    public $cp;
    public $np;
    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
         if(!isset($_SESSION["username"])){redirect(ASETS."/?r=".$this->encript->encdata("login"));}
        return;
    }

    public function initialize() {
        parent::initialize();
        $this->op=$this->filterPost("op");
        $this->np=$this->filterPost("np");
        $this->cp=$this->filterPost("cp");
        return;
    }

    public function execute() {
        parent::execute();
        if(isset($_POST))
        {
            if($this->oldPassword())
            {
               if(strcmp($this->np, $this->cp)==0)
               {
                   $sql=$this->update(array("password"=>$this->np),"enduser").$this->whereSingle(array("userid"=>$this->filterPost("id")));
                   $this->adminDB[$_SESSION["db_1"]]->query($sql);
                   //$this->mongoObject->updateData($this->filterPost("id"),"shopinfo",array("password"=>$this->np));
                   $_SESSION["msg"]=$this->printMessage("Password Chnage Succcess...!","success");
                   $this->isLoadView("VChangePassword", true, array());
               }  else {
               $_SESSION["msg"]=$this->printMessage("Enter Password not match.....!","danger");    
                $this->isLoadView("VChangePassword", true, array());
               }
            }else
            {
                $_SESSION["msg"]="Invalid Old Passowrd";
                //session_destroy();
                 $this->isLoadView("VChangePassword", true, array());
            }
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
    function oldPassword()
    {
        $sql=$this->select("enduser", $_SESSION["db_1"]).$this->whereSingle(array("userid"=>$this->filterPost("id")));
        $result=$this->adminDB[$_SESSION["db_1"]]->query($sql);
        $row=$result->fetch_assoc();
              
        if(strcmp($this->op, $row["password"])==0)
        {
            return true;
        }  else {
            return false;
        }
    }
}