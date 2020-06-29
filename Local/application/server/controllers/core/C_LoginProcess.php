<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once controller;

class C_LoginProcess extends CAaskController {

    //put your code here
    public $visState = false;
    private $email;
    private $password;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        if (isset($_POST["login"])) {
            $this->username = $this->filterPost("username");
            $this->password = $this->filterPost("password");
        }
        return;
    }

    public function initialize() {
        parent::initialize();
        $curenttime = "10:01:00";//date("H:i:s");
        $time = "09:00:00";
        $endtime = "22:30:00";
        $_SESSION["msg"] = "";
        if (strtotime($curenttime) >= strtotime($time) && strtotime($curenttime) <= strtotime($endtime)) {
            $sql = $this->select("user", $_SESSION["db_1"]) . $this->where(array("username" => $this->username), "AND");

            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);

            if ($row = $result->fetch_assoc()) {

                if (strcasecmp($this->username, $row["username"]) == 0 && strcmp($this->password, $this->encript->decdata($row["password"])) == 0) {
                    $this->session_set($row);
                    $_SESSION["sid"] = rand(10, 99);
                    $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("lsession" => $_SESSION["sid"]), "user") . $this->whereSingle(array("id" => 1)));
                    redirect(ASETS . "?r=" . $this->encript->encdata("C_Dashboard"));
                } else {
                    $_SESSION["msg"] = "Invalid email or password ....!";
                    redirect(ASETS);
                }
            } else {
                $_SESSION["msg"] = "Invalid email or password ....!";
                redirect(ASETS);
            }
        } else {
            $_SESSION["msg"] = "Please login after 10:00 am ";
            redirect(ASETS);
        }

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

}
