<?php

require_once controller;
class C_LastResult extends CAaskController {

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
            $result=$this->adminDB[$_SESSION["db_1"]]->query($this->select("winnumber", $_SESSION["db_1"]).$this->orderBy("DESC", "id"));
            if($row=$result->fetch_assoc())
            {
               echo "<h1>Loto Result</h1>";
               echo "<h3><strong>Draw ID: ".$row["gameid"]."</strong></h3>";
               echo "<h3><strong>Draw Time: ".$row["gameetime"]."</strong></h3>";
               $k=10;
               for($i=0;$i<10;$i++)
               {
                   echo "<h4>".$k."=>".sprintf("%02d", $row[$i])."</h4>";
                   $k++;
               }
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