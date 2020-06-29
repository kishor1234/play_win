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
            echo $this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $this->filterPost("id")), "AND");die;
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("entry", $_SESSION["db_1"]) . $this->where(array("id" => $this->filterPost("id")), "AND"));
            if ($row = $result->fetch_assoc()) {
                $p = json_decode($row["point"], true);
                $rs = $this->adminDB[$_SESSION["db_1"]]->query($this->select("winnumber", $_SESSION["db_1"]) . $this->where(array("gameid" => $row["gametimeid"], "gamestime" => $row["gametime"], "gameetime" => $row["gameendtime"], "gdate" => $row["enterydate"]), "AND"));
                if ($r = $rs->fetch_assoc()) {
                    $j = 1000;
                    $winArray = array();
                    for ($i = 0; $i < 10; $i++) {
                        if (isset($p[$i]["e_" . $j . "_" . $r[$i]])) {
                            $winArray = array_merge($winArray, array("e_" . $j . "_" . $r[$i] => $p[$i]["e_" . $j . "_" . $r[$i]]));
                            $this->tpoint = $this->tpoint + (int) $p[$i]["e_" . $j . "_" . $r[$i]];
                        } $j = $j + 100;
                    }
                }
                if (!empty($winArray)) {
                    $this->amount = $this->tpoint * 90;
                    echo "<center>" . $this->happy . "</center>";

                    echo $this->printMessage("You WON..! Amount ₹ " . $this->amount, "success");
                    if ((int) $row["claimstatus"] == 0) {
                        $this->adminDB[$_SESSION["db_1"]]->autocommit(false);
                        $error = array();
                        $er = $this->adminDB[$_SESSION["db_1"]]->query($this->insert("claim", $_SESSION["db_1"], array("enteryid" => $this->filterPost("id"), "winnumber" => json_encode($winArray), "gameid" => $row["gametimeid"], "gametime" => $row["gametime"], "gameetime" => $row["gameendtime"], "cdate" => $row["enterydate"])));
                        $er == false ? array_push($error, "Insert on claim table error") : true;
                        $max = $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id"))), "id");
                        $er = $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("winstatus" => 1, "claimstatus" => 1), "entry") . $this->whereSingle(array("id" => $this->filterPost("id"))));
                        $er == false ? array_push($error, "Update win and claim status  table error") : true;
                        if (!empty($error)) {
                            $this->adminDB[$_SESSION["db_1"]]->rollback();
                            echo $this->printMessage("Error on Claim please try again or contat to adming!", "danger");
                        } else {
                            $this->adminDB[$_SESSION["db_1"]]->commit();
                            ?><a href='javascript:void(0)' class="btn btn-success btn-sm form-control" onclick="postClaim('<?php echo $this->encript->encdata("C_ClaimWinAmount"); ?>', '<?php echo $max; ?>')">Claim for Wining Amount</a>
                            <?php
                        }
                    } else {
                        $max = $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $this->filterPost("id"))), "id");
                        echo $this->printMessage("You Already Claim for Amount ₹ " . $this->amount, "waring");
                        //echo $this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $this->filterPost("id")));
                        ?><a href='javascript:void(0)' class="btn btn-primary btn-sm form-control" onclick="postClaim('<?php echo $this->encript->encdata("C_ClaimWinAmount"); ?>', '<?php echo $this->getData($this->select("claim", $_SESSION["db_1"]) . $this->whereSingle(array("enteryid" => $this->filterPost("id"))), "id"); ?>')">Reprint Claim Recip</a>
                        <?php
                    }
                } else {
                    echo "<center>" . $this->sad . "</center>";
                    echo $this->printMessage("You Lose..!", "danger");
                }
            } else {
                echo "<center>" . $this->sad . "</center>";
                echo $this->printMessage("You Lose..!", "danger");
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
