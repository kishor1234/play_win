<?php

require_once controller;

class C_GetDrawLoadLoto extends CAaskController {

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
            $da=array();
                for ($i = 1000; $i < 2000; $i = $i + 100) {
                    $sql= "SELECT number,`".$_POST["id"]."` FROM lottery.".$i;
                    $m="<th>".$i."<th>";
                    $result=$this->adminDB[$_SESSION["db_1"]]->query($sql);
                    while($row=$result->fetch_assoc())
                    {
                        $m.="<td>".$row[$_POST["id"]]."</td>";
                    }
                    //$m.="</tabel>";
                    array_push($da, $m);
                    $m="";
                }
                
                echo "<table class='table table-hover table-responsive table-striped table-bordered'>";
                echo "<tr>";
                echo"<th>Plat</th>";
                echo"<th></th>";
                for($i=0;$i<100;$i++)
                {
                    echo"<th>".$i."</th>";
                }
                echo "</tr>";
                foreach($da as $k=>$v)
                {
                    echo"<tr>". $v."</tr>";
                }
                echo "</table>";
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
