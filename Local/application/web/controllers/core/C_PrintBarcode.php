<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_PrintBarcode extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        //echo getcwd()."/AaskAPP/phpbarcode/barcode_en.php";die;

        return;
    }

    public function initialize() {
        parent::initialize();
        try {

            echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ticket NO.". $_REQUEST["i"] . "<br>";
            echo "<img src='/AaskAPP/phpbarcode/barcode_en.php?code=$_REQUEST[i]&encoding=EAN&scale=4&mode=png' alt='barcode' height='100' width='300'>";
            echo "<br>";
            echo "<strong>Powered By @aasksoft</strong>";
        } catch (Exception $ex) {
            
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

    function ean_checksum2($ean) {
        $ean = (string) $ean;
        $even = true;
        $esum = 0;
        $osum = 0;
        for ($i = strlen($ean) - 1; $i >= 0; $i--) {
            if ($even)
                $esum+=$ean[$i];
            else
                $osum+=$ean[$i];
            $even = !$even;
        }

        return (10 - ((3 * $esum + $osum) % 10)) % 10;
    }

}
