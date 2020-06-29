<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_CheckWinner extends CAaskController {

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
        //$this->sad = "<img src='https://i0.wp.com/www.aktricks.in/wp-content/uploads/2018/03/3ae816da-3a55-4bac-a613-b5dd5c1dfac5.jpg' style='height:100px;'>";
        $this->sad = "<center><h1 style='color:red;'>No Wining Point!</h1></center>";
        $this->happy = "<img src='/assets/img/happyr.gif' style='height:100px;'>";
        $this->fw = "<img src='/assets/img/fw.gif' style='height:100px;'>";
        return;
    }

    public function execute() {
        parent::execute();
        try {
            if (!empty($this->filterPost("id"))) {

                $s = explode("-", $this->filterPost("id"));
                switch ($s[0]) {
                    case 0:
                        $wdata = array(
                            "1000" => 0,
                            "1100" => 1,
                            "1200" => 2,
                            "1300" => 3,
                            "1400" => 4,
                            "1500" => 5,
                            "1600" => 6,
                            "1700" => 7,
                            "1800" => 8,
                            "1900" => 9
                        );
                        $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $s[1], "own" => $_SESSION["userid"]), "AND"));
                        if ($row = $result->fetch_assoc()) {

                            $p = json_decode($row["point"], true);
                            //print_r($p);
                            $rs = $this->adminDB[$_SESSION["db_1"]]->query($this->select("winnumber", $_SESSION["db_1"]) . $this->where(array("gameid" => $row["gametimeid"], "gamestime" => $row["gametime"], "gameetime" => $row["gameendtime"], "gdate" => $row["enterydate"]), "AND"));
                            if ($r = $rs->fetch_assoc()) {


                                $winArray = array();
                                foreach ($p as $key => $val) {
                                    //echo $key . "==<br>";
                                    foreach ($val as $key1 => $val1) {
                                        if (strcmp($key1, "total") != 0 && strcmp($key1, "tqty") != 0 && strcmp($key1, "tamt") != 0) {
                                            //echo $key1 . "</br>";
                                            $ksplit = explode("_", $key1);
                                            //echo $r[$wdata[$ksplit[1]]];die;
                                            if (isset($p[$key]["e_" . $ksplit[1] . "_" . sprintf("%02d", $r[$wdata[$ksplit[1]]])])) {
                                                $winArray = array_merge($winArray, array("e_" . $ksplit[1] . "_" . sprintf("%02d", $r[$wdata[$ksplit[1]]]) => $p[$key]["e_" . $ksplit[1] . "_" . sprintf("%02d", $r[$wdata[$ksplit[1]]])]));
                                                $this->tpoint = $this->tpoint + (int) $p[$key]["e_" . $ksplit[1] . "_" . sprintf("%02d", $r[$wdata[$ksplit[1]]])];
                                                break;
                                            }
                                        }
                                    }
                                }
                            }

                            //echo $this->tpoint;die;
                            if (!empty($winArray)) {
                                $this->amount = $this->tpoint * 180;
                                echo "<center>" . $this->happy;
                                echo "<h1> ₹ " . $this->amount . "</h1>";
                                echo "</center>";
                                echo $this->printMessage("<strong>Loto You WON.. Point's!.. ₹ " . $this->amount . "</strong>", "success");
                                if ((int) $row["claimstatus"] == 0) {
                                    $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
                                    $error = array();
                                    $er = $this->adminDB[$_SESSION["db_1"]]->query($this->insert("claim", $_SESSION["db_1"], array("enteryid" => $s[1], "winnumber" => json_encode($winArray), "gameid" => $row["gametimeid"], "gametime" => $row["gametime"], "gameetime" => $row["gameendtime"], "cdate" => $row["enterydate"])));
                                    $er == false ? array_push($error, "Insert on claim table error") : true;
                                    $max = $this->adminDB[$_SESSION["db_1"]]->insert_id; // $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id"))), "id");
                                    $er = $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("winamt" => $this->amount, "winstatus" => 1, "claimstatus" => 1), "entry") . $this->whereSingle(array("id" => $s[1])));
                                    $er == false ? array_push($error, "Update win and claim status  table error") : true;
                                    //echo $this->updateINC(array("balance"=>"balance+".$this->amount), "enduser").$this->whereSingle(array("userid"=>$_SESSION["userid"]));
                                    $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("balance" => "balance+" . $this->amount), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]))) != 1 ? array_push($error, "Error on Update Wining Points Update") : true;
                                    //echo($this->insert("transaction", $_SESSION["db_1"], array("userid" => $_SESSION["userid"], "debit" => $this->amount, "remark" => "Winner Point's transfer " . $this->amount . " Invoic ID#" . $this->filterPost("id"), "ip" => $_SERVER["REMOTE_ADDR"], "balance" => $this->getData($this->select("enduser", $_SESSION["db_1"]) . $this->whereSingle(array("userid" => $_SESSION["userid"])), "balance"))));// != 1 ? array_push($error, "Error on Transcation Table Error Code 02 ") : true;
                                    
                                    //$this->adminDB[$_SESSION["db_1"]]->query($this->update(array("winamt"=>$this->amount), "entry").$this->whereSingle(array("id"=>$s[1])))!=1?array_push($error, "Unable to update Net Payable "):true;
                                    $this->adminDB[$_SESSION["db_1"]]->query($this->insert("transaction", $_SESSION["db_1"], array("userid" => $_SESSION["userid"], "debit" => $this->amount, "remark" => "Winner Point\'s transfer " . $this->amount . " Invoic ID#" . $this->filterPost("id"), "ip" => $_SERVER["REMOTE_ADDR"], "balance" => $this->getData($this->select("enduser", $_SESSION["db_1"]) . $this->whereSingle(array("userid" => $_SESSION["userid"])), "balance")))) != 1 ? array_push($error, "Error on Transcation Table Error Code 02 ") : true;
                                    if (!empty($error)) {
                                        $this->adminDB[$_SESSION["db_1"]]->rollback();
                                        print_r($error);
                                        echo $this->printMessage("<strong>Error on Claim please try again or contat to adming!</strong>", "danger");
                                    } else {
                                        $this->adminDB[$_SESSION["db_1"]]->commit();
                                        ?><a href='javascript:void(0)' class="btn btn-success btn-sm form-control" onclick="postClaim('<?php echo $this->encript->encdata("C_ClaimWinAmount"); ?>', '<?php echo $max; ?>')">Claim for Wining Point's</a>
                                        <?php
                                    }
                                } else {
                                    $max = $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $s[1])), "id");
                                    echo $this->printMessage("<strong>You Already Claim for Point's  " . $this->amount . "</strong>", "waring");
                                    //echo $this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $this->filterPost("id")));
                                    ?><a href='javascript:void(0)' class="btn btn-primary btn-sm form-control" onclick="postClaim('<?php echo $this->encript->encdata("C_ClaimWinAmount"); ?>', '<?php echo $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $s[1])), "id"); ?>')">Reprint Claim Recip</a>
                                    <?php
                                }
                            } else {
                                echo "<center>" . $this->sad . "</center><br>";

                                echo $this->printMessage("<strong>No Wining Point's!</strong>", "warning");
                            }
                        } else {
                            echo "<center>" . $this->sad . "</center>";
                            echo $this->printMessage("<strong>No Wining Point's!</strong>", "warning");
                        }
                        break;
                    case 1:
                        $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $s[1], "own" => $_SESSION["userid"]), "AND"));
                        if ($row = $result->fetch_assoc()) {
                            $p = json_decode($row["point"], true);
                            //echo $this->select("wheelwiner", $_SESSION["db_1"]) . $this->where(array("gameid" => $row["gametimeid"], "stime" => $row["gametime"], "etime" => $row["gameendtime"], "cdate" => $row["enterydate"]), "AND");die;
                            $rs = $this->adminDB[$_SESSION["db_1"]]->query($this->select("wheelwiner", $_SESSION["db_1"]) . $this->where(array("gameid" => $row["gametimeid"], "stime" => $row["gametime"], "etime" => $row["gameendtime"], "cdate" => $row["enterydate"]), "AND"));
                            if ($r = $rs->fetch_assoc()) {

                                if (!empty($p[0]["p_" . $r["picked"]])) {
                                    $this->tpoint = $p[0]["p_" . $r["picked"]];
                                    $this->no = $r["picked"];
                                    $this->wnumber = $p[0]["p_" . $r["picked"]];
                                }
                            }
                            if (!empty($this->tpoint)) {
                                $this->amount = $this->tpoint * 18;
                                echo "<center>" . $this->happy;
                                echo "<h1> ₹ " . $this->amount . "</h1>";
                                echo "</center>";
                                echo $this->printMessage("<strong>You WON..! Points ₹ " . $this->amount . "</strong>", "success");
                                if ((int) $row["claimstatus"] == 0) {
                                    $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
                                    $error = array();
                                    $er = $this->adminDB[$_SESSION["db_1"]]->query($this->insert("claim", $_SESSION["db_1"], array("enteryid" => $s[1], "winnumber" => json_encode(array("p_" . $this->no => $this->wnumber)), "gameid" => $row["gametimeid"], "gametime" => $row["gametime"], "gameetime" => $row["gameendtime"], "cdate" => $row["enterydate"])));
                                    $er == false ? array_push($error, "Insert on claim table error") : true;
                                    $max = $this->adminDB[$_SESSION["db_1"]]->insert_id; // $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id"))), "id");
                                    $er = $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("winamt" => $this->amount, "winstatus" => 1, "claimstatus" => 1), "entry") . $this->whereSingle(array("id" => $s[1])));
                                    $er == false ? array_push($error, "Update win and claim status  table error") : true;


                                    $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("balance" => "balance-" . $this->amount), "user") . $this->whereSingle(array("id" => 1))) != 1 ? array_push($error, "Erro(001) Unable to Update Balance.. user") : true;
                                    $this->adminDB[$_SESSION["db_1"]]->query($this->insert("transaction", $_SESSION["db_1"], array("userid" => 1, "debit" => $this->amount, "remark" => "win amount set form admin", "ip" => $_SERVER["REMOTE_ADDR"], "balance" => $this->getData($this->select("user", $_SESSION["db_1"]) . $this->whereSingle(array("id" => 1)), "balance")))) != 1 ? array_push($error, "Error on Transcation Table Error Code 02 ") : true;


                                    $this->adminDB[$_SESSION["db_1"]]->query($this->updateINC(array("balance" => "balance+" . $this->amount), "enduser") . $this->whereSingle(array("userid" => $_SESSION["userid"]))) != 1 ? array_push($error, "Error on Update Wining amount Update") : true;
                                    $this->adminDB[$_SESSION["db_1"]]->query($this->insert("transaction", $_SESSION["db_1"], array("userid" => $_SESSION["userid"], "debit" => $this->amount, "remark" => "Winner point\'s transfer " . $this->amount . " Invoic ID#" . $this->filterPost("id"), "ip" => $_SERVER["REMOTE_ADDR"], "balance" => $this->getData($this->select("enduser", $_SESSION["db_1"]) . $this->whereSingle(array("userid" => $_SESSION["userid"])), "balance")))) != 1 ? array_push($error, "Error on Transcation Table Error Code 02 ") : true;
                                    if (!empty($error)) {
                                        $this->adminDB[$_SESSION["db_1"]]->rollback();
                                        print_r($error);
                                        echo $this->printMessage("<strong>Error on Claim please try again or contat to adming!</strong>", "danger");
                                    } else {
                                        $this->adminDB[$_SESSION["db_1"]]->commit();
                                        ?><a href='javascript:void(0)' class="btn btn-success btn-sm form-control" onclick="postClaim('<?php echo $this->encript->encdata("C_ClaimWinAmountSpin"); ?>', '<?php echo $max; ?>')">Claim for Wining Amount</a>
                                        <?php
                                    }
                                } else {
                                    $max = $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $s[1])), "id");
                                    echo $this->printMessage("<strong>You Already Claim for Amount ₹ " . $this->amount . "</strong>", "waring");
                                    //echo $this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $this->filterPost("id")));
                                    ?><a href='javascript:void(0)' class="btn btn-primary btn-sm form-control" onclick="postClaim('<?php echo $this->encript->encdata("C_ClaimWinAmountSpin"); ?>', '<?php echo $max; ?>')">Reprint Claim Recip</a>
                                    <?php
                                }
                            } else {
                                echo "<center>" . $this->sad . "</center>";
                                echo $this->printMessage("<strong>No Wining Point's!</strong>", "warning");
                            }
                        } else {
                            echo "<center>" . $this->sad . "</center>";
                            echo $this->printMessage("<strong>No Wining Point's!</strong>", "warning");
                        }
                        break;
                    default :
                        echo $this->printMessage("<strong>No Wining Point's!</strong>", "warning");
                        break;
                }
            } else {
                echo $this->printMessage("<strong>No Wining Point's!</strong>", "warning");
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
