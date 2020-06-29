<?php
require_once controller;

class C_GetLastCancelWheel extends CAaskController {

    //put your code here
    public $visState = false;

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        //$this->load->view("login.php");
        parent::create();
        if (!isset($_SESSION["username"])) {
            redirect(ASETS . "?r=" . $this->encript->encdata("main"));
        }
        return;
    }

    public function initialize() {
        parent::initialize();

        return;
    }

    public function execute() {
        parent::execute();
        try {
            echo "<h3><storng>Lucky Wheel Cancel Last Ticket</storng></h3>";
            if (isset($_SESSION["wheellast"])) {
                ?>
                <button class="btn btn-danger " onclick="return deleteTick('#C_LuckyWheelC', '<?php echo $this->encript->encdata("C_CancelTicket"); ?>', '<?php echo "1-" . $_SESSION["wheellast"]; ?>')"><?php echo $_SESSION["wheellast"]; ?></button>
                <?php
            }
        } catch (Exception $ex) {
            
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
