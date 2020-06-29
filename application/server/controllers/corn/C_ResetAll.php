<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once controller;

class C_ResetAll extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
		//die;
        return;
    }

    public function initialize() {
        parent::initialize();
        try {
            $data = $this->allDataZeor(200);
            $sql = "";
            for ($i = 1000; $i < 2000; $i = $i + 100) {
                $sql = $this->updateL($data, "`" . $i . "`") . " ";
                if (!$this->executeQuery($sql)) {
                    throw new Exception("Erro on update questy exceution");
                }
            }
            if (!$this->executeQuery("UPDATE `gametime` SET `status` = '0'")) {
                throw new Exception("Erro on update questy exceution");
            }
            if (!$this->executeQuery("UPDATE `wheelgtime` SET `status` = '0'")) {
                throw new Exception("Erro on update questy exceution");
            }
            $data = $this->allDataZeor(300);
            $sql = "";
            $sql = $this->updateL($data, "`wheelw`") . " ";
            if (!$this->executeQuery("UPDATE `wheelgtime` SET `status` = '0'")) {
                throw new Exception("Erro on update questy exceution");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
            echo $ex->getCode();
        }
        return;
    }

    public function updateL($data, $table) {
        $sql = " UPDATE  " . $table . " SET ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $sql.="`" . $key . "`=" . "'" . $val . "'" . ", ";
            } else {
                $sql.="`" . $key . "`=" . "'" . $val . "'" . " ";
            }
            $i++;
        }
        return $sql;
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

    function allDataZeor($n) {
        $data = array();
        for ($i = 0; $i <= $n; $i++) {
            //$data=array_merge($data,array("".$i.""=>0));
            array_push($data, 0);
            unset($data[0]);
        }
        return $data;
    }

}
