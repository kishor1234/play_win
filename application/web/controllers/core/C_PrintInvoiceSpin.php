<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_PrintInvoiceSpin extends CAaskController {

    //put your code here
    public $mainArray = array();

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        parent::create();
        try {
            $dend = date("H:i:s", strtotime($_SESSION["etimespin"]) - 15);
            $error = array();
            $this->adminDB[$_SESSION["db_1"]]->autocommit(false);


            $temp = array();
            $tqty = 0;
            for ($j = 0; $j < 100; $j++) {
                if (!empty($_POST["p_" . $j])) {
                    $temp = array_merge($temp, array("p_" . $j => $_POST["p_" . $j]));
                    $tqty+=$_POST["p_" . $j];
                }
            }

            array_push($this->mainArray, $temp);
            $tamt = $tqty * 2;
            array_push($this->mainArray, array("tqty" => $tqty, "tamt" => $tamt));
            $dmt = ((float) $tamt * 5 / 100);
            $rmamount = (float) $tamt - $dmt;
            $squery = $this->updateINC(array("balance" => "balance-" . $rmamount), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]));

            // $this->adminDB[$_SESSION["db_1"]]->query($s) != 1 ? array_push($error, "Unable to update enduser balance..") : true;
            //$this->insertData($this->mainArray);
            $adr = array();
            if (empty($_POST["adarr"])) {
                $this->adminDB[$_SESSION["db_1"]]->query($squery) != 1 ? array_push($error, "Unable to update enduser balance..") : true;

                $data = array("own" => $_SESSION["userid"], "game" => "1", "point" => json_encode($this->mainArray), "amount" => $tamt, "totalpoint" => $tqty, "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $_SESSION["stimespin"], "gameendtime" => $_SESSION["etimespin"], "gametimeid" => $_SESSION["gameidspin"]);

                $this->adminDB[$_SESSION["db_1"]]->query($this->insert("entry", $_SESSION["db_1"], $data)) != 1 ? array_push($error, "Unable to insert enty of invice..") : true;
                $last_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                $this->adminDB[$_SESSION["db_1"]]->query($this->insert("usertranscation", $_SESSION["db_1"], array("gid" => 0, "drawid" => $_SESSION["gameidspin"], "userid" => $_SESSION["userid"], "invoiceno" => $last_id, "netamt" => $tamt, "discount" => 5, "discountamt" => $dmt, "total" => $rmamount, "ip" => $_SERVER["REMOTE_ADDR"]))) != 1 ? array_push($error, "Invalid Transcation...") : true;
                //$this->getLastNumber();
                foreach ($temp as $key => $val) {
                    $s = explode("_", $key);
                    $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("`" . $_SESSION["gameidspin"] . "`" => "`" . $_SESSION["gameidspin"] . "`+" . $val), "wheelw") . $this->whereSingle(array("id" => $s[1])));

                    //$this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("weight" => "weight+" . $val), "wheelw") . $this->whereSingle(array("id" => $s[1])));
                }
                $dst = strtotime($dend);
                $dts = strtotime(date("H:i:s"));
                if (empty($error)) {
                    if ($dts <= $dst) {
                        $this->adminDB[$_SESSION["db_1"]]->commit();
                        $_SESSION["wheellast"] = $last_id;
                        $this->printInvoice($last_id);
                    } else {
                        echo "<h2>No point purchase. Time is over.</h2>";
                    }
                } else {
                    $this->adminDB[$_SESSION["db_1"]]->rollback();
                    //print_r($error);
                    echo "Error On Data Insert... Try agian or contact to admin....";
                }
            } else {
                $ad = explode(",", $_POST["adarr"]);
                $ad = array_filter($ad);

                foreach ($ad as $o) {
                    $rads = $this->adminDB[$_SESSION["db_1"]]->query($this->select("wheelgtime", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $o)));
                    if ($r = $rads->fetch_assoc()) {
                        $data = array("own" => $_SESSION["userid"], "game" => "1", "point" => json_encode($this->mainArray), "amount" => $tamt, "totalpoint" => $tqty, "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $r["stime"], "gameendtime" => $r["etime"], "gametimeid" => $r["id"]);
                        $this->adminDB[$_SESSION["db_1"]]->query($this->insert("entry", $_SESSION["db_1"], $data)) != 1 ? array_push($error, "Unable to insert enty of invice..") : true;
                        $last_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                        $this->adminDB[$_SESSION["db_1"]]->query($this->insert("usertranscation", $_SESSION["db_1"], array("gid" => 0, "drawid" => $r["id"], "userid" => $_SESSION["userid"], "invoiceno" => $last_id, "netamt" => $tamt, "discount" => 5, "discountamt" => $dmt, "total" => $rmamount, "ip" => $_SERVER["REMOTE_ADDR"]))) != 1 ? array_push($error, "Invalid Transcation...") : true;
                        //$this->getLastNumber();
                        $this->adminDB[$_SESSION["db_1"]]->query($squery) != 1 ? array_push($error, "Unable to update enduser balance..") : true;

                        foreach ($temp as $key => $val) {
                            $s = explode("_", $key);
                            $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("`" . $o . "`" => "`" . $o . "`+" . $val), "wheelw") . $this->whereSingle(array("id" => $s[1])));
                            // $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("weight" => "weight+" . $val), "wheelw") . $this->whereSingle(array("id" => $s[1])));
                        }
                    }

                    if (empty($error)) {
                        $this->adminDB[$_SESSION["db_1"]]->commit();
                        $this->printInvoice($last_id);
                    } else {
                        $this->adminDB[$_SESSION["db_1"]]->rollback();
                        //print_r($error);
                        echo "Error On Data Insert... Try agian or contact to admin....";
                    }
                }
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
        $data = array("point" => json_encode($array), "amount" => $_POST["tamt"], "totalpoint" => $_POST["tqty"], "enterydate" => date("Y-m-d"), "ip" => $_SERVER["REMOTE_ADDR"], "gametime" => $_SESSION["stime"], "gameendtime" => $_SESSION["etime"], "gametimeid" => $_SESSION["gameid"]);
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
                // echo "<center>";

                echo "<strong>";
                echo "<span style='font-size:20px;'><strong>LUCKY WHEEL</strong></span><br>";
                //echo "<span style='font-size:15px;'>Agent ID:<strong>" . $_SESSION["userid"] . "</strong></span></br>";
                echo "<span style='font-size:15px;'>Date: " . $row["isDate"] . "</span><br>";
                echo "<span style='font-size:18px;'>Draw ID: " . $row["gametimeid"] . "</span><br>";
                echo "<span style='font-size:18px;'>Draw Time: " . $row["gameendtime"] . "</span><br>";
                $this->pritnNumberDataSPIN($row["point"]);
                echo"<br>";
                echo "Invoice: 1-" . $id . "<br>";
                echo '<svg id="barcode' . $id . '" class="bar"></svg>';
                ?>
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js" integrity="sha256-BjqnfACYltVzhRtGNR2C4jB9NAN0WxxzECeje7/XpwE=" crossorigin="anonymous"></script>

                <script>
                    //JsBarcode("#barcode<?php //echo $id;    ?>", "<?php //echo "1-" . $id;    ?>");
                    JsBarcode("#barcode<?php echo $id; ?>", "<?php echo "1-" . $id; ?>", {
                        height: 40,
                        displayValue: true
                    });
                </script>
                <?php
                echo "<br><br>";
                echo "</strong>";
				//echo "<img src='AaskAPP/phpbarcode/Barcode_128.php?text=1-" . $row["id"] . " alt='barcode'>";
            }
        } catch (Exception $ex) {
            
        }
    }

}
