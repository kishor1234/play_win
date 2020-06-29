<?php

require_once controller;
class C_GetLastLototTicket extends CAaskController {

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
            echo "<h3><storng>Lotto Last Three Ticket</storng></h3>";
                                $sql = $this->select("entry", $_SESSION['db_1']) . $this->where(array("game" => 0, "own" => $_SESSION["userid"]),"AND") . $this->orderBy("DESC", "id") . $this->limitWithOutOffset(3);
                                $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
                                echo "<table class='table table-boardred'><tr>";
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <td><button onclick="return ReprintPost('#reprintform', '<?php echo $this->encript->encdata("C_ReprintTicket"); ?>', '#reprintdisply', '<?php echo "0-" . $row["id"]; ?>');" class='btn btn-success btn-sm form-control'><?php echo $row["id"]; ?></button></td>
                                    <?php
                                }
                                echo "</tr></table>";
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