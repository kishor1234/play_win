<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_ReprintTicket extends CAaskController {

    //put your code here
    public $amount = 0;
    public $sad;
    public $happy;
    public $fw;
    public $tpoint = 0;
    public $wnumber = 0;
    public $no;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();
        if (!isset($_SESSION["username"])) {
            redirect(ASETS . "?r=" . $this->encript->encdata("main"));
        }
        return;
    }

    public function initialize() {
        parent::initialize();
        $this->sad = "<img src='assets/img/sad.gif' style='height:100px;'>";
        $this->happy = "<img src='/assets/img/happyr.gif' style='height:100px;'>";
        $this->fw = "<img src='/assets/img/fw.gif' style='height:100px;'>";
        return;
    }

    public function execute() {
        parent::execute();
        try {
            //echo "<script src='https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js' type='text/javascript'></script>";
            //https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js
            $s = explode("-", $this->filterPost("id"));
            switch ($s[0]) {
                case 0:
                    $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $s[1], "own" => $_SESSION["userid"]), "AND"));
                    if ($row = $result->fetch_assoc()) {
                        ?>
                       <!-- <link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC:700" rel="stylesheet">-->
                       <style>
                            #printinvoice
                            
                            {
                                font-family: 'Noto Serif SC', serif;
                            }
                            #barcode{
                                margin-top: -25px;
                            }
                        </style>
                        <strong id='printinvoice'>
                            <?php
                            echo "<span style='font-size: 20px;' id='printinvoice'><strong>Shubh</strong></span><br>";
                            //echo "<span style='font-size:15px;'>Agent ID:<strong>" . $_SESSION["userid"] . "</strong></span></br>";
                            echo "<span style='font-size: 15px;' id='printinvoice'>Date: " . $row["isDate"] . "</span><br>";
                            echo "<span style='font-size: 15px;' id='printinvoice'>Draw ID: " . $row["gametimeid"] . "</span>&nbsp;&nbsp;";
                            echo "<span style='font-size: 15px;' id='printinvoice'>Draw Time: " . $row["gameendtime"] . "</span><br>";
                            $this->pritnNumberData($row["point"]);
                            echo"<br>";
                            echo "<p id='printinvoice'>Invoice: 0-" . $s[1] . "</p><br>";
                            echo '<svg id="barcode" class="bar"></svg>';
                            ?>
                            <script>
                                //JsBarcode("#barcode", "<?php //echo "0-" . $row["id"];      ?>");
                                JsBarcode("#barcode", "<?php echo "0-" . $row["id"]; ?>", {
                                    height: 40,
                                    displayValue: true
                                });
                            </script>
                            <?php
                            //echo "<img src='http://www.abarcode.net/barcode.aspx?value=1-".$row["id"]."' alt='barcode'>";
                            ?><br><button id='btn' onclick="reprint('#reprintdisply', '#btn')">Print</button>
                            <?php
                            echo "</strong>";
                        } else {
                            echo $this->printMessage("Invalid Barcode...", "danger");
                        }
                        break;
                    case 1:
                        $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $s[1], "own" => $_SESSION["userid"]), "AND"));
                        if ($row = $result->fetch_assoc()) {
                            echo "<strong>";
                            echo "<span style='font-size:20px;'><strong>LUCKY WHEEL</strong></span><br>";
                            //echo "<span style='font-size:15px;'>Agent ID:<strong>" . $_SESSION["userid"] . "</strong></span></br>";
                            echo "<span style='font-size:15px;'>Date: " . $row["isDate"] . "</span><br>";
                            echo "<span style='font-size:18px;'>Draw ID: " . $row["gametimeid"] . "</span><br>";
                            echo "<span style='font-size:18px;'>Draw Time: " . $row["gameendtime"] . "</span><br>";
                            $this->pritnNumberDataSPIN($row["point"]);
                            echo"<br>";
                            echo "Invoice: 1-" . $s[1] . "<br>";
                            echo '<svg id="barcode" class="bar"></svg>';
                            ?>
                            <script>
                                //JsBarcode("#barcode", "<?php //echo "1-" . $row["id"];      ?>");
                                JsBarcode("#barcode", "<?php echo "1-" . $row["id"]; ?>", {
                                    height: 40,
                                    displayValue: true
                                });
                            </script>
                            <?php
                            //echo "<img src='http://www.abarcode.net/barcode.aspx?value=1-".$row["id"]."' alt='barcode'>";
                            ?><br><button id='btn' onclick="reprint('#reprintdisply', '#btn')">Print</button>
                            <?php
                            echo "</strong>";
                        } else {
                            echo $this->printMessage("Invalid Barcode...", "danger");
                        }
                        break;
                    default;
                        echo $this->printMessage("Invalid Barcode", "danger");
                        break;
                }
            } catch (Exception $ex) {
                $this->adminDB[$_SESSION["db_1"]]->rollback();
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
    