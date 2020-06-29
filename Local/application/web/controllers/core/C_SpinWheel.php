<?php

require_once controller;
class C_SpinWheel extends CAaskController {

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
            $resutl=$this->adminDB[$_SESSION["db_1"]]->query($this->select("wheelwiner", $_SESSION["db_1"]).$this->whereSingle(array("cdate"=>date("Y-m-d"))).$this->orderBy("DESC", "id"));
            if($row=$resutl->fetch_assoc())
            {
                $row["er"]=1;
                echo json_encode($row);
            }else{
                $row["er"]=0;$row["msg"]="Faild...";
                echo json_encode($row);
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