<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_PrintInvoice extends CAaskController {

    //put your code here
    public $mainArray = array();

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();
        try {
            //print_r($_POST);die;
            //$this->insertData($this->mainArray);
            //echo "Init Time ".date("H:i:s")."<br>";
            $dend = date("H:i:s", strtotime($_SESSION["etime"]) - 15);

            $adr = array();
            if (empty($_POST["adarr"])) {

                $error = array();
                $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
                $_POST["own"] = $_SESSION["userid"];
                $_POST["game"] = "0";
                for ($i = 10; $i < 20; $i++) {
                    if (!empty($_POST["sel_" . $i])) {
                        $select = $_POST["sel_" . $i];
                        $temp = array();
                        for ($j = 0; $j < 100; $j++) {
                            if (!empty($_POST["e_" . $select . "_" . sprintf("%02d", $j)])) {
                                $temp = array_merge($temp, array("e_" . $select . "_" . sprintf("%02d", $j) => $_POST["e_" . $select . "_" . sprintf("%02d", $j)]));
                                $qq = $this->updateINC(array("`" . $_SESSION["gameid"] . "`" => "`" . $_SESSION["gameid"] . "`" . "+" . $_POST["e_" . $select . "_" . sprintf("%02d", $j)]), "lottoweight") . $this->whereSingle(array("number" => sprintf("%02d", $j)));
                                $this->adminDB[$_SESSION["db_1"]]->query($qq) != 1 ? array_push($error, "Update load Shubh error") : true;
                                $qq = $this->updateINC(array("`" . $_SESSION["gameid"] . "`" => "`" . $_SESSION["gameid"] . "`" . "+" . $_POST["e_" . $select . "_" . sprintf("%02d", $j)]), "`" . $select . "`") . $this->whereSingle(array("number" => sprintf("%02d", $j)));
                                $this->adminDB[$_SESSION["db_1"]]->query($qq) != 1 ? array_push($error, "Update load Shubh spacifict draw error") : true;
                            }
                        }
                        $t = array("totalqty" => $_POST['totalqty_' . $select], "totalamt" => $_POST['totalamt_' . $select]);
                        $temp = array_merge($temp, array("total" => $t));
                        array_push($this->mainArray, $temp);
                    }
                }
                array_push($this->mainArray, array("tqty" => $_POST["tqty"], "tamt" => $_POST["tamt"]));
                $dmt = ((float) $this->filterPost("tamt") * 5 / 100);
                $rmamount = (float) $this->filterPost("tamt") - $dmt;
                $s = $this->updateINC(array("balance" => "balance-" . $rmamount), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]));

                $this->adminDB[$_SESSION["db_1"]]->query($s) != 1 ? array_push($error, "Unable to update enduser balance..") : true;

                $data = array("own" => $_SESSION["userid"], "game" => "0", "point" => json_encode($this->mainArray), "amount" => $_POST["tamt"], "totalpoint" => $_POST["tqty"], "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $_SESSION["stime"], "gameendtime" => $_SESSION["etime"], "gametimeid" => $_SESSION["gameid"]);
                $this->adminDB[$_SESSION["db_1"]]->query($this->insert("entry", $_SESSION["db_1"], $data)) != 1 ? array_push($error, "Unable to insert enty of invice..") : true;
                $last_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                $_SESSION["lotolid"] = $last_id;
                $dst = strtotime($dend);
                $dts = strtotime(date("H:i:s"));
                if ($dts <= $dst) {
                    $this->adminDB[$_SESSION["db_1"]]->query($this->insert("usertranscation", $_SESSION["db_1"], array("gid" => 1, "drawid" => $_SESSION["gameid"], "userid" => $_SESSION["userid"], "invoiceno" => $last_id, "netamt" => $this->filterPost("tamt"), "discount" => 5, "discountamt" => $dmt, "total" => $rmamount, "ip" => $_SERVER["REMOTE_ADDR"]))) != 1 ? array_push($error, "Invalid Transcation...") : true;
                } else {
                    array_push($error, "Error on Time");
                    echo "<h2>No point purchase.Time is over.</h2>";
                }
            } else {
                //Advance Draw Ticket
                $ad = explode(",", $_POST["adarr"]);
                $ad = array_filter($ad);
                //print_r($ad);
                foreach ($ad as $o) {
                    $this->mainArray = array();
                    $rads = $this->adminDB[$_SESSION["db_1"]]->query($this->select("gametime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $o)));
                    if ($r = $rads->fetch_assoc()) {
                        $error = array();
                        $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
                        $_POST["own"] = $_SESSION["userid"];
                        $_POST["game"] = "0";
                        $sona = 1000;
                        for ($i = 10; $i < 20; $i++) {
                            if (!empty($_POST["sel_" . $i])) {
                                $select = $_POST["sel_" . $i];
                                $temp = array();
                                for ($j = 0; $j < 100; $j++) {
                                    if (!empty($_POST["e_" . $select . "_" . sprintf("%02d", $j)])) {
                                        $temp = array_merge($temp, array("e_" . $select . "_" . sprintf("%02d", $j) => $_POST["e_" . $select . "_" . sprintf("%02d", $j)]));
                                        $qq = $this->updateINC(array("`" . $o . "`" => "`" . $o . "`" . "+" . $_POST["e_" . $select . "_" . sprintf("%02d", $j)]), "lottoweight") . $this->whereSingle(array("number" => sprintf("%02d", $j)));
                                        $this->adminDB[$_SESSION["db_1"]]->query($qq);
                                        $qq = $this->updateINC(array("`" . $o . "`" => "`" . $o . "`" . "+" . $_POST["e_" . $select . "_" . sprintf("%02d", $j)]), "`" . $sona . "`") . $this->whereSingle(array("number" => sprintf("%02d", $j)));
                                        $this->adminDB[$_SESSION["db_1"]]->query($qq);
                                    }
                                }

                                $t = array("totalqty" => $_POST['totalqty_' . $select], "totalamt" => $_POST['totalamt_' . $select]);
                                $temp = array_merge($temp, array("total" => $t));
                                array_push($this->mainArray, $temp);
                            }
                            $sona = $sona + 100;
                        }
                        array_push($this->mainArray, array("tqty" => $_POST["tqty"], "tamt" => $_POST["tamt"]));
                        $dmt = ((float) $this->filterPost("tamt") * 5 / 100);
                        $rmamount = (float) $this->filterPost("tamt") - $dmt;
                        $s = $this->updateINC(array("balance" => "balance-" . $rmamount), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]));
//end
                        $data = array("own" => $_SESSION["userid"], "game" => "0", "point" => json_encode($this->mainArray), "amount" => $_POST["tamt"], "totalpoint" => $_POST["tqty"], "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $r["stime"], "gameendtime" => $r["etime"], "gametimeid" => $r["id"]);
                        $this->adminDB[$_SESSION["db_1"]]->query($this->insert("entry", $_SESSION["db_1"], $data)) != 1 ? array_push($error, "Unable to insert enty of invice..") : true;
                        $last_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                        array_push($adr, $last_id);
                        $this->adminDB[$_SESSION["db_1"]]->query($this->insert("usertranscation", $_SESSION["db_1"], array("gid" => 1, "drawid" => $r["id"], "userid" => $_SESSION["userid"], "invoiceno" => $last_id, "netamt" => $this->filterPost("tamt"), "discount" => 5, "discountamt" => $dmt, "total" => $rmamount, "ip" => $_SERVER["REMOTE_ADDR"]))) != 1 ? array_push($error, "Invalid Transcation...") : true;
                        $this->adminDB[$_SESSION["db_1"]]->query($s) != 1 ? array_push($error, "Unable to update enduser balance..") : true;
                    }
                }
            }
            //$this->getLastNumber();
            //$d = "18:15:01";
            $dst = strtotime($dend);
            $dts = strtotime(date("H:i:s"));

            if (empty($error)) {


                $_SESSION["lotolast"] = $last_id;
                if (empty($adr)) {
                    if ($dts <= $dst) {
                        $this->printInvoice($last_id);
                        $this->adminDB[$_SESSION["db_1"]]->commit();
                    } else {
                        echo "<h2>No point purchase.Time is over.</h2>";
                    }
                } else {
                    foreach ($adr as $last_id) {
                        $this->printInvoice($last_id);
                        $this->adminDB[$_SESSION["db_1"]]->commit();
                    }
                }
                //$this->printInvoice($last_id);
            } else {
                $this->adminDB[$_SESSION["db_1"]]->rollback();
                print_r($error);
                echo "Error On Data Insert... Try agian or contact to admin....";
            }
        } catch (Exception $ex) {
            
        }
        return;
    }

    public function initialize() {
        parent::initialize();
        return;
    }

    public function execute() {
        parent::execute();
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

    function insertData($array) {
        $data = array("point" => json_encode($array), "amount" => $_POST["tamt"], "totalpoint" => $_POST["tqty"], "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $_SESSION["stime"], "gameendtime" => $_SESSION["etime"], "gametimeid" => $_SESSION["gameid"], "gameno" => 0);
        $this->adminDB[$_SESSION["db_1"]]->query($this->insert("entry", $_SESSION["db_1"], $data));
        //echo $this->insert("entry", $_SESSION["db_1"], $data);
    }

    function getLastNumber() {
        try {
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->selectMax("entry", "id"));
            $row = $result->fetch_assoc();
            $this->printInvoice($row["max(id)"]);
        } catch (Exception $ex) {
            
        }
    }

    function printInvoice($id) {
        try {
            $sql = $this->select("entry", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $id));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                //echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">';
                //echo ' <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js" type="text/javascript"></script>';
                ?>
                <!--<link href="https://fonts.googleapis.com/css?family=Noto+Serif+SC:700" rel="stylesheet">
                --><style>
                    #printinvoice
                    {
                        font-family: 'Noto Serif SC', serif;
                    }
                    .bar{
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
                    echo "<p id='printinvoice'>Invoice: 0-" . $id . "</p><br>";
                    echo '<svg id="barcode' . $id . '" class="bar"></svg>';
                    ?>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js" integrity="sha256-BjqnfACYltVzhRtGNR2C4jB9NAN0WxxzECeje7/XpwE=" crossorigin="anonymous"></script>
                    <script>
                       JsBarcode("#barcode<?php echo $id; ?>", "<?php echo "0-" . $id; ?>", {
                                height: 40,
                                displayValue: true
                            });
                      
                    </script>
                    <?php
                    echo "<br><br>";
                    echo "</strong>";
                    //echo "<img src='AaskAPP/phpbarcode/Barcode_128.php?text=0-" . $row["id"] . " alt='barcode'>";
                }
            } catch (Exception $ex) {
                
            }
        }

    }
    