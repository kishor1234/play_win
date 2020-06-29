<?php
require_once controller;

class C_GetLastCancelLoto extends CAaskController {

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
            echo "<h3><storng>Lotto Cancel Last Ticket</storng></h3>";
            if (isset($_SESSION["lotolast"])) {
                ?>
                <button class="btn btn-danger " onclick="return deleteTick('#C_DashboardC', '<?php echo $this->encript->encdata("C_CancelTicket"); ?>', '<?php echo "0-" . $_SESSION["lotolast"]; ?>')"><?php echo $_SESSION["lotolast"]; ?></button>
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
