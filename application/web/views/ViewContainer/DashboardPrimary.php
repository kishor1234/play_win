<html>
    <head>
        <title>
            Dashboard
        </title>
        <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <script src="/assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            #require{color:red;}
            body{
                background-color: #F7E29C;
                
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <center>
                    <?php
                    if (!empty($_SESSION["msg"])) {
                        echo '<div class="col-lg-4 col-lg-offset-4">';
                        echo $main->printMessage($_SESSION["msg"], "danger");
                        echo "</div>";
                        $_SESSION["msg"] = "";
                    }
                    ?>
                
                <div class="col-lg-4 col-lg-offset-1" style="margin-top:150px; opacity: 0.9;">
                    <a href="/?r=<?php echo $obj->encdata("C_Dashboard"); ?>"> <img src="https://i.dailymail.co.uk/i/newpix/2018/05/31/10/4CB0A7F600000578-5788445-The_National_Lottery_Lotto_promises_a_1_8_million_prize_for_the_-m-1_1527758819893.jpg" style="width:300px; height: 300px;">

                        <p style="color:#000;"><strong>Shubh jackpot</strong></p>
                    </a>
                </div>
                <div class="col-lg-4 col-lg-offset-1" style="margin-top:150px; opacity: 0.9;">
                    <a href="/?r=<?php echo $obj->encdata("C_LuckyWheel"); ?>"> <img src="https://previews.123rf.com/images/viktorijareut/viktorijareut1707/viktorijareut170700330/82122747-roue-d-illustration-raster-de-la-fortune-ic%C3%B4ne-de-spin-chanceux-dans-un-style-plat-.jpg" style="width:300px; height: 300px;">
                        <p style="color:#000;"><strong>Lucky Wheel</strong></p>
                    </a>
                </div>
                </center>
            </div>
        </div>
        <br>
       
<script>
    $("document").ready(function () {
        $("#reset").click(function () {
            $("#email").val("");
            $("#pwd").val("");
        });
    });
</script>
</body>
</html>