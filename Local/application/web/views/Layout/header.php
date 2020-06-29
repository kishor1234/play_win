<html>
    <head>
        <title>
            OM Game

        </title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/assets/css/bootstrap_yeti.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/flipclock/css/flipclock.css" rel="stylesheet" type="text/css"/>
        <script src="/assets/js/jquery-1.12.4.js" type="text/javascript"></script>
        <!--<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>-->
        <script src="/assets/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="/assets/flipclock/js/flipclock.js" type="text/javascript"></script>
        <script src="/assets/js/fa.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js" type="text/javascript"></script>
        <link rel="icon" href="/favicon.ico">
        <!--<link href="/assets/gfont.css" rel="stylesheet" type="text/css"/>-->
        <style>
            body{
                font-family: 'Noto Serif SC', serif;
            }
            /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1; 
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888; 
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }
            #require{color:red;
            }
            .canvasjs-chart-credit{display: none;}
            #canvas
            {
                border-radius: 100%;
                border-style: solid;
                border-color: #92a8d1;
                background-color: #FFF;
            }
            #canvasbg{
                position: fixed;
                z-index: -9999;
                display: none;

            }
            /* The container */
            .con {
                display: block;
                position: relative;
                padding-left: 35px;
                margin-bottom: 5px;
                cursor: pointer;
                font-size: 15px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .con input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
            }

            /* On mouse-over, add a grey background color */
            .con:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .con input:checked ~ .checkmark {
                background-color: #2196F3;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .con input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .con .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            #holiday{
                color: red;
                background-color: yellow;

            }
            body{
                <?php
                switch ($_REQUEST["r"]) {
                    case "C_Dashboard":
                        ?>
                        background: rgb(255, 232, 183);
                        //color:#F7E6B9;
                        //background-image: url("assets/bg/bg1.jpg");
                        //background-repeat: repeat;
                        <?php
                        break;
                   
                    case "C_LuckyWheel":
                        ?>
                        background-image: url("assets/bg/bg1.jpg");
                        background-repeat: repeat;
                        <?php
                        break;
                    default :
                         ?>
                        background-image: url("assets/bg/bg1.jpg");
                        background-repeat: repeat;
                        <?php
                        break;
                }
                ?>


            }
           
        </style>

    </head>
    <body>
        <canvas id="canvasbg"></canvas>


        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div id="holiday">
                <?php
                $date = date("Y-m-d");
                $date = strtotime($date);
                $date = strtotime("+1 day", $date);
                $date = date('Y-m-d', $date);
                $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("message", $_SESSION["db_1"]) . $main->whereSingle(array("on_date" => $date)));
                if ($row = $result->fetch_assoc()) {
                    echo "<marquee style='font-size:20px;'>" . $row["msg"] . "</marquee>";
                }
                ?>
            </div>
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/?r=<?php echo $obj->encdata("C_Dashboard1"); ?>">
                        OM GAME
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">


                        <li class="dropdown">
                            <a href="/?r=<?php echo $obj->encdata("C_Dashboard1"); ?>" >Home </a>

                        </li>

                        <li class="dropdown">
                            <a href="/?r=<?php echo $obj->encdata("C_Report"); ?>" >Reports</a>
                        </li>

                        <li class="dropdown">
                            <a href="/?r=<?php echo $obj->encdata("C_OpenLinkTrue") . "&v=" . $obj->encdata("VChangePassword"); ?>" >Change Password </a>

                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="modal" data-target="#cancel" onclick="clearDiv('#canceldisplay')" > Cancel Point's </a>

                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="modal" data-target="#reprint" onclick="clearDiv('#reprintdisply')"> Reprint </a>

                        </li>

                        <li class="dropdown">
                            <a href="#" data-toggle="modal" data-target="#advDraPrint"> Advance Draw </a>

                        </li>
                        <li class="dropdown">
                            <a href="/?r=<?php echo $obj->encdata("C_OpenLinkTrue") . "&v=" . $obj->encdata("VResultALL"); ?>" data-toggle="modal"> Result </a>

                        </li>

                    </ul>

                    <form class="navbar-form navbar-left" role="search"  action="#" method="post" role="search" id="search"  onsubmit="return formPost4('#search', '<?php echo $obj->encdata("C_CheckWinner"); ?>', '#ClaimTicketModalResult');">
                        <div class="form-group">

                            <input type="text" class="form-control" placeholder="Claim Winning Points" name="id" id="brscan" autofocus="" autocomplete="off">

                        </div>

                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="javascript:void(0)" style="color:red; background-color:yellow; font-size: 15px;" ><strong>POINTS:- <span id="bal" style="color:#red; font-size: 15px;"></span></strong> </a>

                        </li>
                        <li><a class="btn btn-danger form-control" href="/?r=<?php echo $obj->encdata("C_Logout"); ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2">
                <div id="msg">

                    <?php
                    if (!empty($_SESSION["msg"])) {
                        echo $_SESSION["msg"];
                        $_SESSION["msg"] = "";
                    }
                    ?>

                </div>
            </div>
        </div>

        <div id="myWin" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Claim Point</h4>
                    </div>
                    <div class="modal-body">
                        <form  action="#" method="post" role="search" id="search"  onsubmit="return formPost3('#search', '<?php echo $obj->encdata("C_CheckWinner"); ?>', '#windisplay');">
                            <div class="form-group">
                                <label>Scan Barcode </label>
                                <input type="text" class="form-control" placeholder="Barcode" name="id" id="id">

                            </div>

                        </form>
                        <div id="windisplay">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="cancel" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cancel Points Using Bar Code</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $r = "";
                        if (isset($_REQUEST["r"])) {
                            $r = $_REQUEST["r"];
                        }
                        switch ($r) {
                            case "C_Dashboard":
                                echo "<div id='C_DashboardC'>";
                                echo "<h3><storng>Lotto Cancel Last Point</storng></h3>";
                                if (isset($_SESSION["lotolast"])) {
                                    ?>
                                    <button class="btn btn-danger " onclick="return deleteTick('#C_DashboardC', '<?php echo $obj->encdata("C_CancelTicket"); ?>', '<?php echo "0-" . $_SESSION["lotolast"]; ?>')"><?php echo $_SESSION["lotolast"]; ?></button>
                                    <?php
                                }
                                echo "</div>";
                                break;
                            case "C_LuckyWheel":
                                echo "<div id='C_LuckyWheelC'>";
                                echo "<h3><storng>Lucky Wheel Cancel Last Point</storng></h3>";
                                if (isset($_SESSION["wheellast"])) {
                                    ?>
                                    <button class="btn btn-danger " onclick="return deleteTick('#C_LuckyWheelC', '<?php echo $obj->encdata("C_CancelTicket"); ?>', '<?php echo "1-" . $_SESSION["wheellast"]; ?>')"><?php echo $_SESSION["wheellast"]; ?></button>
                                    <?php
                                }
                                echo "</div>";
                                break;
                            default :
                                ?>
                                <form  action="#" method="post" role="search" id="cancelForm"  onsubmit="return formPost3('#cancelForm', '<?php echo $obj->encdata("C_CancelTicket"); ?>', '#canceldisplay');">
                                    <div class="form-group">
                                        <label>Scan Bar Code </label>
                                        <input type="text" class="form-control" placeholder="Barcode" name="id" id="id">

                                    </div>

                                </form>
                                <?php
                                break;
                        }
                        ?>

                        <div id="canceldisplay">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>        
        <div id="reprint" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reprint</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $r = "";
                        if (isset($_REQUEST["r"])) {
                            $r = $_REQUEST["r"];
                        }
                        switch ($r) {
                            case "C_Dashboard":
                                echo "<div id='C_Dashboard'>";
                                echo "<h3><storng>Lotto Last Three Ticket</storng></h3>";
                                $sql = $main->select("entry", $_SESSION['db_1']) . $main->where(array("game" => 0, "own" => $_SESSION["userid"]), "AND") . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(3);
                                $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
                                echo "<table class='table table-boardred'><tr>";
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <td><button onclick="return ReprintPost('#reprintform', '<?php echo $obj->encdata("C_ReprintTicket"); ?>', '#reprintdisply', '<?php echo "0-" . $row["id"]; ?>');" class='btn btn-success btn-sm form-control'><?php echo $row["id"]; ?></button></td>
                                    <?php
                                }
                                echo "</tr></table></div>";
                                break;
                            case "C_LuckyWheel":
                                echo "<div id='C_LuckyWheel'>";
                                echo "<h3><storng>Lucky Wheel Last Three Point</storng></h3>";
                                $sql = $main->select("entry", $_SESSION['db_1']) . $main->where(array("game" => 1, "own" => $_SESSION["userid"]), "AND") . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(3);
                                $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
                                echo "<table class='table table-boardred'><tr>";
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <td><button onclick="return ReprintPost('#reprintform', '<?php echo $obj->encdata("C_ReprintTicket"); ?>', '#reprintdisply', '<?php echo "1-" . $row["id"]; ?>');" class='btn btn-success btn-sm form-control'><?php echo $row["id"]; ?></button></td>
                                    <?php
                                }
                                echo "</tr></table></div>";
                                break;
                            default :
                                ?>
                                <form  action="#" method="post" role="search" id="reprintform"  onsubmit="return formPost3('#reprintform', '<?php echo $obj->encdata("C_ReprintTicket"); ?>', '#reprintdisply');">
                                    <div class="form-group">
                                        <label>Scan Barcode </label>
                                        <input type="text" class="form-control" placeholder="Barcode" name="id" id="id">

                                    </div>

                                </form>
                                <?php
                                break;
                        }
                        ?>
                        <!---->
                        <div id="reprintdisply">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div> 

        <div id="advDraPrint" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Advance Draw</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        if (strcmp($_REQUEST["r"], $obj->decdata("C_LuckyWheel")) == 0) {
                            ?>
                            <div id="lwheelad">
                                <?php
                                $main->isLoadView("VLuckyWheelAdvanceDrawList", false, array());
                                ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div id="lotoad">
                                <?php
                                $main->isLoadView("VLottoAdvanceDrawList", false, array());
                                ?>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div> 
        <div id="printInvoiceNew" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <button  onclick="reprint('#printInvoiceContain', '#btn')" >Print</button>
                        </h4>
                    </div>
                    <div class="modal-body">

                        <div id="printInvoiceContain">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div> 
        <div id="printInvoiceNewSpin" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <button  onclick="printloto('#printInvoiceContainSpin', '#btn')" >Print</button>
                        </h4>
                    </div>
                    <div class="modal-body">

                        <div id="printInvoiceContainSpin">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div> 
        <div id="claimTicketmodal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            Claim Point
                        </h4>
                    </div>
                    <div class="modal-body">

                        <div id="ClaimTicketModalResult">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div> 
