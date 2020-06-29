<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once getcwd() . "/AaskAPP/CStringEncDec.php";
require('phpmailer/class.phpmailer.php');
require('textlocal.class.php');
define("MSG_Error", "error");

class CAaskController extends CI_Controller {

    public $controllerConfig;
    public $fileStack;
    public $viewConfig;
    public $controllerAppConfig;
    public $modelConfig;
    public $requestArray;
    public $moduleObj;
    public $actionObj;
    public $encript;
    public $adminDB;
    public $mailObject;
    public $ltemail = "null";
    public $api = "null";

    //public $mongoObject;
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->encript = new CStringEncDec();
        $this->controllerAppConfig = array();
        $this->controllerConfig = array();
        $this->fileStack = array();
        $this->viewConfig = array();
        $this->requestArray = array();
        $this->adminDB = array();
        $this->adminDB = $this->createDBO();
        $this->mailObject = new PHPMailer();
        //$this->mongoObject= new CMongoDB();
        return;
        //$this->create();
    }

    function removeArray() {
        foreach ($this->controllerConfig as $a) {
            array_pop($this->controllerConfig);
        }
        foreach ($this->fileStack as $a) {
            array_pop($this->fileStack);
        }
    }

    /*  life cycle */

    public function create() {
        //$this->encript = new CStringEncDec();
        //$this->viewConfig = $this->listFolderFiles(getcwd() . "/" . APPLICATION . "/views"); //array fo view files
        //$this->controllerAppConfig = $this->listFolderFiles(getcwd() . "/" . APPLICATION . "/controllers/"); //array of controllers
        $this->encript = new CStringEncDec();
        if (!isset($_SESSION["viewConfig"]) && !isset($_SESSION["controllerAppConfig"])) {
            $_SESSION["viewConfig"] = $this->listFolderFiles(getcwd() . "/" . APPLICATION . "/views"); //array fo view files
            $_SESSION["controllerAppConfig"] = $this->listFolderFiles(getcwd() . "/" . APPLICATION . "/controllers/"); //array of controllers
            $this->viewConfig = $_SESSION["viewConfig"];
            $this->controllerAppConfig = $_SESSION["controllerAppConfig"];
        } else {
            $_SESSION["viewConfig"] = $this->listFolderFiles(getcwd() . "/" . APPLICATION . "/views"); //array fo view files
            $_SESSION["controllerAppConfig"] = $this->listFolderFiles(getcwd() . "/" . APPLICATION . "/controllers/"); //array of controllers

            $this->viewConfig = $_SESSION["viewConfig"];
            $this->controllerAppConfig = $_SESSION["controllerAppConfig"];
        }

        return;
    }

    public function initialize() {
        return;
    }

    public function execute() {

        return;
    }

    public function finalize() {

        return;
    }

    public function reader() {
        return;
    }

    public function distory() {
        $this->removeArray();
        //unset($this->mongoObject);
        unset($this->adminDB);
        unset($this->encript);
        return;
    }

    /* end  life cycle */

    function viewHome($viewName) {
        $this->load->view($this->viewConfig[$viewName]);
        return true;
    }

    function viewSpacific($viewName, $flag, $header, $footer, $data) {
        $data["obj"] = $this->encript;
        $data["main"] = $this;
        if ($flag == true) {
            $this->load->view($this->viewConfig[$header], $data);
            $this->load->view($this->viewConfig[$viewName], $data);
            $this->load->view($this->viewConfig[$footer], $data);
        } else {
            $this->load->view($this->viewConfig[$viewName], $data);
        }
    }

    function loadView($viewName, $flag) {
        $data["obj"] = $this->encript;
        $data["k"] = "work";
        if ($flag == true) {
            $this->load->view($this->viewConfig["header"], $data);
            $this->load->view($this->viewConfig[$viewName], $data);
            $this->load->view($this->viewConfig["footer"], $data);
        } else {

            $this->load->view($this->viewConfig[$viewName], $data);
        }
    }

    public function test() {
        return "work";
    }

    public function sendmailWithoutAttachment($reciver, $sender, $sendername, $msg, $subject) {
        $mail = $this->mailObject;
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "info@gmail.com";
        $mail->Password = "gmaile@123";
        $mail->Host = "google.com";
        $mail->Mailer = "smtp";
        $mail->SetFrom($sender, $sendername);
        $mail->AddReplyTo($sender, $sendername);
        $mail->AddAddress($reciver);
        $mail->Subject = $subject;
        $mail->WordWrap = 80;
        $mail->MsgHTML($msg);
        $mail->IsHTML(true);
        if (isset($_FILES)) {
            if (is_array($_FILES)) {
                $mail->AddAttachment($_FILES['attachmentFile']['tmp_name'], $_FILES['attachmentFile']['name']);
            }
        }
        if (!$mail->Send()) {
            //echo "<p class='error'>Problem in Sending Mail.</p>";
        } else {
            //echo "<p class='success'>Contact Mail Sent.</p>";
        }
    }

    public function orderBy($order, $id) {
        return " ORDER BY " . $id . " " . $order . " ";
    }

    public function isLoadView($viewName, $flag, $data) {
        $data["obj"] = $this->encript;
        $data["main"] = $this;
        if ($flag == true) {
            $this->load->view($this->viewConfig["header"], $data);
            if (array_key_exists($viewName, $this->viewConfig)) {
                $this->load->view($this->viewConfig[$viewName], $data);
            } else {
                $this->load->view($this->viewConfig["page_404"], $data);
            }
            $this->load->view($this->viewConfig["footer"], $data);
        } else {

            if (array_key_exists($viewName, $this->viewConfig)) {
                $this->load->view($this->viewConfig[$viewName], $data);
            } else {
                $this->load->view($this->viewConfig["page_404"], $data);
            }
        }
    }

    public function isLoadViewSp($header, $footer, $viewName, $flag, $data) {
        $data["obj"] = $this->encript;
        $data["main"] = $this;

        if ($flag == true) {
            $this->load->view($this->viewConfig[$header], $data);
            if (array_key_exists($viewName, $this->viewConfig)) {
                $this->load->view($this->viewConfig[$viewName], $data);
            } else {
                $this->load->view($this->viewConfig["404"], $data);
            }
            //$this->load->view($this->viewConfig[$viewName], $data);
            $this->load->view($this->viewConfig[$footer], $data);
        } else {

            $this->load->view($this->viewConfig[$viewName], $data);
        }
    }

    /* function loadClasses() {

      foreach ($this->requestArray as $key => $val) {
      switch ($key) {
      case "module":
      require_once getcwd() . "/" . APPLICATION . "/controllers/" . $this->controllerAppConfig[$val];
      break;
      case "action":
      require_once getcwd() . "/" . aaskModel . $this->modelConfig[$val];
      //$this->actionObj=new $val;
      break;
      //die(getcwd()."/".APPLICATION."/controllers/".$this->controllerAppConfig["login"]);
      require_once getcwd() . "/" . APPLICATION . "/controllers/" . $this->controllerAppConfig["login"];
      default:break;
      }
      }
      } */

    function getClassName() {

        if (isset($_REQUEST)) {

            foreach ($_REQUEST as $key => $value) {
                $this->requestArray[$key] = $value;
            }
            if (count($this->requestArray) == 0) {
                $this->requestArray["module"] = "login";
            }
        }
        return;
    }

    function listFolderFiles($dir) {
        $ffs = scandir($dir);
        foreach ($ffs as $ff) {//$tempDir = $ff;
            if ($ff != '.' && $ff != '..') {
                if (is_dir($dir . '/' . $ff)) {
                    array_push($this->fileStack, $ff);
                    $this->listFolderFiles($dir . '/' . $ff);
                } else {
                    $ext = explode(".", $ff);
                    if (isset($ext[1])) {
                        if (strcmp($ext[1], "php") == 0) {
                            $filePath = "";
                            foreach ($this->fileStack as $stackDir) {
                                $filePath.=$stackDir . "/";
                            }
                            $this->controllerConfig[$ext[0]] = $filePath . $ff;
                        }
                    }
                }
            }
        }array_pop($this->fileStack);
        return $this->controllerConfig;
    }

    public function setMessage($msg) {
        define("MSG_Error", $msg);
    }

    public function checkLogin() {
        if (isset($_SESSION['userEmail'])) {

            return true;
        } else {
            return false;
        }
    }

    public function createDBO() {

        if (false) {
            $tempObjArray = array();
            $tempObjArray["lottery"] = new mysqli("localhost", "root", "", "lottery");
            $_SESSION["db_1"] = "lottery";
        } else {
            $tempObjArray = array();
            $tempObjArray["lottery"] = new mysqli("localhost", "root", "root@123", "lottery");
            $_SESSION["db_1"] = "lottery";
        }

        /*
          $tempObjArray = array();
          $tempObjArray["studyans_loto"] = new mysqli("localhost", "studyans_usr", "aaskSoft@123", "studyans_loto");
          $_SESSION["db_1"]="studyans_loto";
         */

        return $tempObjArray;
    }

    public function updateQuery($sql, $db) {

        $this->adminDB = $this->createDBO();
        if ($this->adminDB[$db]->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($table, $db, $data) {

        $sql = "INSERT INTO " . $table;
        $t = "( ";
        $t2 = "( ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $t = $t . "`" . $key . "`" . ",";
                $t2 = $t2 . "'" . $val . "'" . ",";
            } else {
                $t = $t . "`" . $key . "`" . " )";
                $t2 = $t2 . "'" . $val . "'" . " )";
            }
            $i++;
        }
        return $sql = $sql . " " . $t . " values " . $t2;
        //return $this->adminDB[$db]->query($sql);
    }

    public function select($table, $db) {
        return $sql = "SELECT * FROM " . $db . "." . $table . " ";
        //return $this->adminDB[$db]->query($sql);
    }

    public function selectDistinct($table, $id) {
        return "SELECT DISTINCT " . $id . " FROM " . $table . " ";
    }

    function selectJoinData($data1, $data2, $jointype, $table, $oncol) {
        $s = "SELECT ";
        foreach ($data1 as $k1 => $d1) {
            foreach ($d1 as $kk1 => $dd1) {
                $s.=$k1 . "." . $dd1 . " , ";
            }
        }
        foreach ($data2 as $k1 => $d1) {
            $i = 1;
            foreach ($d1 as $kk1 => $dd1) {
                if ($i != count($d1)) {
                    $s.=$k1 . "." . $dd1 . " , ";
                } else {
                    $s.=$k1 . "." . $dd1 . " ";
                }$i++;
            }
        }
        $s.=" FROM ";
        $i = 1;
        foreach ($table as $kt => $tb) {
            if ($i != count($table)) {
                $s.= $tb . " " . $jointype . " ";
            } else {
                $s.= $tb . " ";
            }$i++;
        }
        $s.=" ON ";
        $i = 1;
        foreach ($oncol as $kt => $tb) {
            if ($i != count($oncol)) {
                $s.= $kt . "." . $tb . " = ";
            } else {
                $s.= $kt . "." . $tb . " ";
            }$i++;
        }
        return $s;
    }

    public function whereBetweenDates($colname, $d1, $d2) {
        $sql = " WHERE ";
        $sql.="DATE(" . $colname . ") BETWEEN '" . $d1 . "' AND '" . $d2 . "'";
        return $sql;
    }

    public function whereBetweenDatesID($colname, $d1, $d2, $key, $id) {
        $sql = " WHERE ";
        $sql.="DATE(" . $colname . ") BETWEEN '" . $d1 . "' AND '" . $d2 . "'" . " AND " . $key . "='" . $id . "'";
        return $sql;
    }

    public function whereSingleLikeArray($key, $val, $data) {
        $sql = " WHERE ";
        $sql.=$key . " LIKE " . "'%" . $val . "%' AND ";
        $i = 1;
        $and = "AND";
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $sql.=$key . "=" . "'" . $val . "'" . " " . $and . " ";
            } else {
                $sql.=$key . "=" . "'" . $val . "'" . " ";
            }
            $i++;
        }
        return $sql;
    }

    public function whereBetweenDatesArray($colname, $d1, $d2, $data) {
        $sql = " WHERE ";
        $sql.="DATE(" . $colname . ") BETWEEN '" . $d1 . "' AND '" . $d2 . "'" . " AND ";
        $i = 1;
        $and = "AND";
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $sql.=$key . "=" . "'" . $val . "'" . " " . $and . " ";
            } else {
                $sql.=$key . "=" . "'" . $val . "'" . " ";
            }
            $i++;
        }
        return $sql;
    }

    public function selectCount($table, $col) {
        return "SELECT count(" . $col . ") FROM " . $table . " ";
    }

    public function selectMax($table, $col) {
        return "SELECT max(" . $col . ") FROM " . $table . " ";
    }

    public function selectSum($table, $col) {
        return "SELECT sum(" . $col . ") FROM " . $table . " ";
    }

    public function limitWithOffset($offset, $limit) {
        return " LIMIT " . $offset . " , " . $limit . " ";
    }

    public function limitWithOutOffset($limit) {
        return " LIMIT " . $limit . " ";
    }

    public function delete($table) {
        return "DELETE FROM " . $table . " ";
    }

    public function updateINC($data, $table) {
        $sql = " UPDATE  " . $table . " SET ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $sql.=$key . "=" . "" . $val . "" . ", ";
            } else {
                $sql.=$key . "=" . "" . $val . "" . " ";
            }
            $i++;
        }
        return $sql;
    }

    public function where($data, $and) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $sql.=$key . "=" . "'" . $val . "'" . " " . $and . " ";
            } else {
                $sql.=$key . "=" . "'" . $val . "'" . " ";
            }
            $i++;
        }
        return $sql;
    }

    public function whereSingle($data) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=$key . "=" . "'" . $val . "'";
            }
        }
        return $sql;
    }

    public function whereNesQuery($data) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=$key . "=" . "(" . $val . ")";
            }
        }
        return $sql;
    }

    public function update($data, $table) {
        $sql = " UPDATE  " . $table . " SET ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i != count($data)) {
                $sql.=$key . "=" . "'" . $val . "'" . ", ";
            } else {
                $sql.=$key . "=" . "'" . $val . "'" . " ";
            }
            $i++;
        }
        return $sql;
    }

    public function filterPost($variable_name) {
        return filter_input(INPUT_POST, $variable_name);
    }

    public function filterGet($variable_name) {
        return filter_input(INPUT_GET, $variable_name);
    }

    public function filterRequest($variable_name) {
        return filter_input(INPUT_REQUEST, $variable_name);
    }

    public function selectQuery($sql, $db) {

        $this->adminDB = $this->createDBO();
        return $this->adminDB[$db]->query($sql);
    }

    public function getRandomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*";

        $count = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $count);

            $pass[$i] = $alphabet[$n];
        }

        return implode($pass);
    }

    public function sendMail($reciverEmail, $subject, $message) {

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <no-replay@gmail.com>' . "\r\n";
        mail($reciverEmail, $subject, $message, $headers);
        return true;
    }

    public function sendMailBySp($from, $reciverEmail, $subject, $message) {

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <' . $from . '>' . "\r\n";
        mail($reciverEmail, $subject, $message, $headers);
        return true;
    }

    public function sendSMS($mobile, $message) {
        $textlocal = new Textlocal($this->ltemail, $this->api);

        $numbers = array($mobile);
        $sender = 'Textlocal';
        //$message = 'This is a message';

        try {
            $result = $textlocal->sendSms($numbers, $message, $sender);
            //print_r($result);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
        return true;
    }

    public function newUrl($var) {

        $arrayHostUrl = explode('.', HOSTURL);

        for ($i = 0; $i < count($arrayHostUrl); $i++) {
            if ($i == 0) {
                
            } else {
                $var.="." . $arrayHostUrl[$i];
            }
        }
        return $var;
    }

    function isValidMobile($mobile) {
        if (!empty($mobile)) { // phone number is not empty
            if (preg_match('/^\d{10}$/', $mobile)) { // phone number is valid
                return true;
                // your other code here
            } else { // phone number is not valid
                return false;
            }
        } else { // phone number is empty
            return false;
        }
    }

    function isPasswordValid($password) {
        $passwordErr = "";
        if (!empty($password)) {

            if (strlen($password) <= '8') {
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Number!";
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
            return $passwordErr;
        }
    }

    function sendMailtoUser($email) {
        $message = "<a href='" . ASETS . "/?r=" . $this->encript->encdata('C_UserEmailVerify') . "&q=" . $this->encript->encdata($this->getID($email)) . "&d=" . $this->encript->encdata(date("d-m-Y")) . "'>Verify</a>";
        $this->sendMail($this->filterPost("inputEmail"), "PB verification mail", $message);
        return $message;
    }

    public function dayCount($from, $to) {
        $first_date = strtotime($from);
        $second_date = strtotime($to);
        $offset = $second_date - $first_date;
        return floor($offset / 60 / 60 / 24);
    }

    /* function getID($email)
      {
      $data = array(
      "email" => $email
      );
      $cursor = $this->mongoObject->selectData("en_user", $data);
      if ($cursor != false) {
      $data=$cursor->getNext();
      return $data["_id"];
      }
      return 0;
      } */

    public function session_set($data) {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function session_get($key) {
        return $_SESSION[$key];
    }

    public function session_destrory() {
        session_destroy();
    }

    public function printMessage($msg, $type) {

        $mssg = '<div class="alert alert-dismissible alert-' . $type . '">';
        $mssg.='<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $mssg.=$msg;
        $mssg.='</div>';
        return $mssg;
    }

    public function getIndianCurrency($number) {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
                $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else
                $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Point\'s Only ' : '') . $paise;
    }

    public function whereSingleLike($data) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=$key . " LIKE " . "'%" . $val . "%'";
            }
        }
        return $sql;
    }

    public function whereSingleLikeAndArray($data, $data2) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=$key . " LIKE " . "'%" . $val . "%'";
            }
        }
        $sql.=" AND ";
        $and = "AND";
        foreach ($data2 as $key => $val) {
            if ($i != count($data)) {
                $sql.=$key . "=" . "'" . $val . "'" . " " . $and . " ";
            } else {
                $sql.=$key . "=" . "'" . $val . "'" . " ";
            }
            $i++;
        }
        return $sql;
    }

    public function whereSinglelessthanequal($data) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=$key . "<=" . "'" . $val . "'";
            }
        }
        return $sql;
    }

    public function whereSinglegreaterthanequal($data) {
        $sql = " WHERE ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=$key . ">=" . "'" . $val . "'";
            }
        }
        return $sql;
    }

    public function whereSearchLike($coloum, $data) {
        $sql = " WHERE CONCAT_WS(";
        $i = 1;
        foreach ($coloum as $val) {
            if ($i == count($coloum)) {
                $sql.=$val;
            } else {
                $sql.=$val . ",";
            }
            $i++;
        }
        $sql.=" ) ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=" LIKE " . "'%" . $val . "%'";
            }
        }
        return $sql;
    }

    public function searchFullText($coloum, $data) {
        $sql = " WHERE MATCH(";
        $i = 1;
        foreach ($coloum as $val) {
            if ($i == count($coloum)) {
                $sql.=$val;
            } else {
                $sql.=$val . ",";
            }
            $i++;
        }
        $sql.=" ) AGAINST ( ";
        $i = 1;
        foreach ($data as $key => $val) {
            if ($i == count($data)) {
                $sql.=" " . "'" . $val . "'IN NATURAL LANGUAGE MODE )";
            }
        }
        return $sql;
    }

    public function getBranchName($id) {

        try {
            $result = $this->adminDB[$_SESSION["db_1"]]->query($this->select("hf_branch", $_SESSION["db_1"]) . $this->whereSingle(array("id" => $id)));
            $row = $result->fetch_assoc();
            return $row["blocation"];
        } catch (Exception $ex) {
            return "";
        }
    }

    public function getData($sql, $col) {
        try {
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $row = $result->fetch_assoc();
            return $row[$col];
        } catch (Exception $ex) {
            
        }
    }

    public function getAge($dob) {
        $date1 = new DateTime($dob);
        $date2 = new DateTime(date("Y-m-d"));
        $diff = $date1->diff($date2);

        return $diff->y . " Y, " . $diff->m . "M, " . $diff->d . "D";
    }

    public function getAgeinMonth($dob) {
        $date1 = new DateTime($dob);
        $date2 = new DateTime(date("Y-m-d"));
        $diff = $date1->diff($date2);
        $month = (((int) $diff->y) * 12) + $diff->m;
        return $month . "." . $diff->d;
    }

    public function createClassobject($moduleName) {
        //print_r($this->controllerAppConfig);
        if (array_key_exists($moduleName, $this->controllerAppConfig) == FALSE) {
            $strFullDetail = $this->removePhpExtenstion($this->controllerAppConfig["Cpage_404"]);
        } else {
            $strFullDetail = $this->removePhpExtenstion($this->controllerAppConfig[$moduleName]);
        }

        require_once $strFullDetail["fullPath"];
        $controlObject = new $strFullDetail["class"];
        return $controlObject;
    }

    public function removePhpExtenstion($filePath) {
        $strArrayfullDetail = array();
        $strControlfullPath = getcwd() . "/application/super/controllers/" . $filePath;

        $strArray = explode("/", $strControlfullPath);
        $strClassName = explode(".", $strArray[count($strArray) - 1]);
        if (false != file_exists($strControlfullPath)) {
            if (class_exists($strControlfullPath, FALSE) == FALSE) {
                //require_once($strControlfullPath . "");
                $strArrayfullDetail["fullPath"] = $strControlfullPath;
                $strArrayfullDetail["class"] = $strClassName[0];
            }
        } else {
            die("file not found");
        }
        return $strArrayfullDetail;
    }

    public function executeQuery($sql) {
        return $this->adminDB[$_SESSION["db_1"]]->query($sql);
    }

    public function accnoPading($number, $n, $l) {

//$result = substr($phone, 0, 4);
        $result = "****";
        $result .= substr($number, $n, $l);
        return $result;
    }

    function pritnNumberDataSPIN($string) {

        echo "<table class=''><tr><th>NUM</th><th></th><th>&nbsp;Q&nbsp;</th><th>NUM</th><th></th><th>&nbsp;Q&nbsp;</th></tr>";
        $data = json_decode($string);
        $optr = "<tr><strong>";
        $cltr = "</strong></tr>";
        $fl = 0;
        $tqty = 0;
        $tamt = 0;
        foreach ($data as $key => $value) {
            if ($fl == 0) {
                echo $optr;
            }
            foreach ($value as $k => $val) {

                if (strcmp($k, "total") != 0) {

                    if (strcmp($k, "tqty") != 0 && (strcmp($k, "tamt") != 0)) {
                        $s = explode("_", $k);
                        echo "<td><strong><center>" . $s[1] . "</center></strong></td><td></td><td><strong>" . $val . "</strong></td>";
                        $fl++;
                    } else {
                        if (strcmp($k, "tqty") == 0) {
                            $tqty = $val;
                        } else if (strcmp($k, "tamt") == 0) {
                            $tamt = $val;
                        }
                    }
                }
                if ($fl > 1) {
                    $fl = 0;
                    echo $cltr . $optr;
                }
            }
        }
        echo "</table>";
        echo "<table><tr><th>Tota Quantity</th><th>:</th><td><strong>" . $tqty . "</strong></td></table>";
        echo "<table><tr><th>Tota Points</th><th>:</th><td><strong>" . $tamt . "</strong></td></table>";
        echo "<strong>Using for amusement only</strong>";
    }

    public function pritnNumberData($string) {

        echo "<table style='font-weight:bold;' id='printinvoice'><tr><th>NUM</th><th>Q</th><th>NUM</th><th>Q</th><th>NUM</th><th>Q</th></tr>";
        $data = json_decode($string);
        $optr = "<tr><strong>";
        $cltr = "</strong></tr>";
        $fl = 0;
        $tqty = 0;
        $tamt = 0;
        foreach ($data as $key => $value) {
            if ($fl == 0) {
                echo $optr;
            }
            foreach ($value as $k => $val) {

                if (strcmp($k, "total") != 0) {

                    if (strcmp($k, "tqty") != 0 && (strcmp($k, "tamt") != 0)) {
                        $s = explode("_", $k);
                        echo "<td><strong >" . $s[1] / 100 . "-" . $s[2] . "</strong></td><td><strong>" . $val . "&nbsp;</strong></td>";
                        $fl++;
                    } else {
                        if (strcmp($k, "tqty") == 0) {
                            $tqty = $val;
                        } else if (strcmp($k, "tamt") == 0) {
                            $tamt = $val;
                        }
                    }
                }
                if ($fl > 2) {
                    $fl = 0;
                    echo $cltr . $optr;
                }
            }
        }
        echo "</table>";
        echo "<table id='printinvoice'><tr><th>Tota QTY</th><th>:</th><td><strong>" . $tqty . "</strong></td></table>";
        echo "<table id='printinvoice'><tr><th>Tota Points</th><th>:</th><td><strong>" . $tamt . "</strong></td></table>";
        echo "<strong id='printinvoice'>Using for amusement only</strong>";
    }

}
