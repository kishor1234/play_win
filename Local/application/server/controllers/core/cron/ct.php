<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//<CalendarTrigger>
//      <StartBoundary>2019-10-11T20:39:50</StartBoundary>
//      <Enabled>true</Enabled>
//      <ScheduleByDay>
//        <DaysInterval>1</DaysInterval>
//      </ScheduleByDay>
//    </CalendarTrigger>
/**
 * Description of ct
 *
 * @author asksoft
 */
require_once controller;

class ct extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();

        return;
    }

    public function initialize() {
        parent::initialize();
        switch ($_REQUEST["i"]) {
            case "loto":
                $this->getLoto();
                break;
            case "wheel":
                $this->getLucky();
                break;
            default:
                break;
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

    function getLucky() {
        $sql = $this->adminDB[$_SESSION["db_1"]]->query("SELECT * FROM `wheelgtime`");

        while ($row = $sql->fetch_assoc()) {
            $row["etime"];
            $s = explode(":", $row["etime"]);
            $etime = "";
            switch ((int) $s[1]) {
                case "00":
                    $etime = sprintf("%02d", ($s[0] - 1)) . ":" . sprintf("%02d", (60 - 1)) . ":50";
                    break;
                default:
                    $etime = sprintf("%02d", $s[0]) . ":" . sprintf("%02d", ($s[1] - 1)) . ":50";
                    break;
            }
            //$etime=$s[0].":".($s[1]-1).":50";
            echo $ms = "<CalendarTrigger>
            <StartBoundary>2019-10-11T{$etime}</StartBoundary>
            <Enabled>true</Enabled>
            <ScheduleByDay>
            <DaysInterval>1</DaysInterval>
            </ScheduleByDay>
            </CalendarTrigger>";
        }
    }

    function getLoto() {
        $sql = $this->adminDB[$_SESSION["db_1"]]->query("SELECT * FROM `gametime`");

        while ($row = $sql->fetch_assoc()) {
            $row["etime"];
            $s = explode(":", $row["etime"]);
            $etime = "";
            switch ((int) $s[1]) {
                case "00":
                    $etime = sprintf("%02d", ($s[0] - 1)) . ":" . sprintf("%02d", (60 - 1)) . ":50";
                    break;
                default:
                    $etime = sprintf("%02d", $s[0]) . ":" . sprintf("%02d", ($s[1] - 1)) . ":50";
                    break;
            }
            //$etime=$s[0].":".($s[1]-1).":50";
            echo $ms = "<CalendarTrigger>
            <StartBoundary>2019-10-11T{$etime}</StartBoundary>
            <Enabled>true</Enabled>
            <ScheduleByDay>
            <DaysInterval>1</DaysInterval>
            </ScheduleByDay>
            </CalendarTrigger>";
        }
    }

}
