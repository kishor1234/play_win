<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_ClaimWinAmount extends CAaskController {

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
            $sql = $this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id")));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $row = $result->fetch_assoc();
            $this->printRicp($this->filterPost("id"), $row);

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

    public function printRicp($id, $data) {
        ?>
        <style>

            *{padding: 0;margin: 0;}
            table{
                font-size: 10px;
            }
            
            span{
            font-size: 10px;
            }</style>
        <div id="print">
            <center>
                <h4>Lottery Winer Claim</h4>
                <span>Claim ID: <stong><?php echo $data["id"]; ?></stong></span><br>
                <span>Date: <?php echo date("d-m-Y h:i:s a"); ?></span><br>
                <table class="table table-bordered" >
                    <tr><th>Draw Plat No</th><th>Num</th><th>Point</th><th>Paid Amount</th><th>Win Amount</th></tr>

                    <?php
                    $winnumber = json_decode($data["winnumber"], true);
                    $tp = 0;
                    $tpm = 0;
                    $twa = 0;
                    foreach ($winnumber as $key => $val) {
                        echo "<tr>";
                        $d = explode("_", $key);
                        echo "<td>" . $d[1] . "</td>";
                        echo "<td>" . $d[2] . "</td>";
                        echo "<td>" . $val . "</td>";
                        $tp = $tp + $val;
                        echo "<td>₹ " . ($val * 2) . "</td>";
                        $tpm = $tpm + ($val * 2);
                        echo "<td>₹ " . ($val * 90) . "</td>";
                        $twa = $twa + ($val * 90);
                        echo "</tr>";
                    }
                    echo "<tr>";
                    $d = explode("_", $key);
                    echo "<td><strong>Total</strong></td>";
                    echo "<td>&nbsp;</td>";
                    echo "<td> " . $tp . "</td>";
                    echo "<td>₹ " . $tpm . "</td>";
                    echo "<td>₹ " . $twa . "</td>";
                    echo "</tr>";
                    ?>
                </table>
                <?php
                echo "<strong>".$this->getIndianCurrency($twa)."</strong><br>";
                echo "<table><tr><th>Game ID</th><th>:</th><td>".$data["gameid"]."</td></tr>";
                echo "<tr><th>Game Start</th><th>:</th><td>".$data["gametime"]."</td></tr>";
                echo "<tr><th>Game End</th><th>:</th><td>".$data["gameetime"]."</td></tr>";
                ?>
                
                <img src="/AaskAPP/phpbarcode/Barcode_128.php?text=<?php echo $id; ?>&print=true&codetype=code128&scale=4&mode=png" alt="Barcode">
                <!--<a href="javascript:void(0);" onclick="print('print','#myform<?php echo $this->number; ?>')" >Print</a>
            ---></center>
        </div>
        <?php
    }

}
