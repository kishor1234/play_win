<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_PrintAdvTicket extends CAaskController {

    //put your code here
    public $visState = false;
    public $number;
    public $point;
    public $amount;

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
            $this->number = $this->filterPost("number");
            $this->point = $this->filterPost("points" );
            $this->amount = $this->filterPost("amount");
            $winamount = (float) $this->point * 60;
            $s = $this->select("gametime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id")));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($s);
            if ($row = $result->fetch_assoc()) {
                $data = array("number" => $this->number, "point" => $this->point, "amount" => $this->amount, "winamount" => $winamount, "enterydate" => date("Y-m-d H:i:s "), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $row["stime"], "gameendtime" => $row["etime"], "gametimeid" => $row["id"]);

                $sql = $this->insert("entry", $_SESSION["db_1"], $data);
                $this->adminDB[$_SESSION["db_1"]]->query($sql);
                $sql = $this->selectMax("entry", "id");
                $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
                if ($row = $result->fetch_assoc()) {
                    $this->id = $row["max(id)"];
                    $this->printTicket();
                } else {
                    echo $this->printMessage("Ticket Generate Faild please try again leter...!", "danger");
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

    public function printTicket() {
        ?>
        <div id="print">
            <center>
                <h1>Lottery</h1>
                <h1 style="font-size: 50px;"><stong><?php echo $this->number; ?></stong></h1>
                <table class="table table-bordered">
                    <tr>
                        <th>Number</th>
                        <th>:</th>
                        <td><?php echo $this->number; ?></td>
                    </tr>
                    <tr>
                        <th>Points</th>
                        <th>:</th>
                        <td><?php echo $this->point; ?></td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <th>:</th>
                        <td><?php echo $this->amount; ?></td>
                    </tr>
                </table>
                <img src="#" alt="Barcode">
                <!--<a href="javascript:void(0);" onclick="print('print','#myform<?php echo $this->number; ?>')" >Print</a>
            ---></center>
        </div>
        <?php
    }

}
