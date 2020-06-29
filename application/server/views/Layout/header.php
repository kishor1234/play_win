<html>
    <head>
        <title>
            Admin|OM Game

        </title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link href="/assets/css/bootstrap_yeti.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet" type="text/css"/>
        <!--<link href="/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        -->

        <link href="/assets/flipclock/css/flipclock.css" rel="stylesheet" type="text/css"/>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="/assets/js/jquery.validate.min.js" type="text/javascript"></script>

        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <script src="/assets/flipclock/js/flipclock.js" type="text/javascript"></script>


        <script src="/assets/js/fa.js" type="text/javascript"></script>
        <style>

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
            #bal{
                color: red;
                
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
        </style>

    </head>
    <body>
        <canvas id="canvasbg"></canvas>
        <br>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                       OM GAME
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">

                     <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MASTER <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VAddAdminBalance")."&tk=0";?>','#main');">ADD POINT</a></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VCreateID")."&tk=0";?>','#main');" >CREATE  ID </a>

                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VAllUser")."&tk=0";?>','#main');">VIEW All ID </a>

                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VHollidayMsg")."&tk=0";?>','#main');">HOLLIDAY MSG</a>

                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VDrawListLoto")."&tk=0";?>','#main');">LOTO DRAW LIST</a>

                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VDrawListLucky")."&tk=0";?>','#main');">LUCKY WHL DRAW LIST</a>

                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Manuel Result <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VMLuckyWheel")."&tk=0";?>','#main');">Lucky Wheel</a></li>
                                <li><a href="javascript:void(0)" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_OpenLinkFalse")."&v=".$obj->encdata("VMLotto")."&tk=0";?>','#main');">Lotto</a></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="/" >REFRESH (F5) </a>

                        </li>
                       
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                       
                        <li><a href="#"><strong>POINTS:= <span id="bal">1000.00</span> </strong>  <i class="fa fa-refresh"></i></a></li>
                        
                        <li><a href="/?r=<?php echo $obj->encdata("C_Logout"); ?>">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2">
                <div id="msg" style="position: absolute; z-index:999; margin-top: 20px;">

                    <?php
                    //$_SESSION["msg"]=$main->printMessage("Success...!","success");
                    if (!empty($_SESSION["msg"])) {
                        echo "<center>".$_SESSION["msg"]."</center>";
                        $_SESSION["msg"] = "";
                    }
                    ?>

                </div>
            </div>
        </div>
        