<br><br>
<div class="container-fluid">

    <div class="row">
        <!-- <div class="col-lg-4">
 
 
             <div >
                 <div id="chart" style="width:50px; display: none;"></div>
                 <div id="question" ><h1>2</h1></div>
                 <php $main->isLoadView("VWheelServer", false, array()); ?>    
             </div>
            
             <div class="panel panel-warning" style="margin:2em; ">
 
 
                 <div class="panel panel-body">
 
                     <legend> Game 1 </legend>
        <?php
        $sql = $main->select("gametime", $_SESSION["db_1"]) . $main->whereSinglelessthanequal(array("stime" => date("H:i:s"))) . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(1);
        $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
        if ($row = $result->fetch_assoc()) {
            $_SESSION["gameid"] = $row["id"];
            $_SESSION["stime"] = $row["stime"];
            $_SESSION["etime"] = $row["etime"];
        }
        ?>
                     <div class="clock" ></div>
                 </div>
             </div>
             <div class="panel panel-warning" style="margin:2em; ">
 
 
                 <div class="panel panel-body">
 
                     <legend> Game 2 </legend>
        <?php
        $sql = $main->select("wheelgtime", $_SESSION["db_1"]) . $main->whereSinglelessthanequal(array("stime" => date("H:i:s"))) . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(1);
        $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
        if ($row = $result->fetch_assoc()) {
            $_SESSION["gameidspin"] = $row["id"];
            $_SESSION["stimespin"] = $row["stime"];
            $_SESSION["etimespin"] = $row["etime"];
        }
        ?>
                     <div class="clockSpin" ></div>
                 </div>
             </div>
 
         </div>-->
        <div class="col-lg-12">
            <br><br>
            <div id="main">
                <center>
                    <?php
                    $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("ws", $_SESSION["db_1"]));
                    if ($row = $result->fetch_assoc()) {
                        ?>
                        <strong>Lotto Percentage <span id="per"> <?php echo $row["id"]; ?></span> %</strong>
                        <?php
                    }
                    ?>

                    <div class="form-group">
                        <form action="javascript:void(0)" method="post" id="myid" onsubmit="return formPost('#myid', '<?php echo $obj->encdata("C_SetPer"); ?>', '#per')">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="form-group">
                                    <label class="col-lg-2"><strong>Select Per.</strong> </label>
                                    <div class="col-lg-8">
                                        <input type="number" id="id" name="id" required="" placeholder="Enter Percentage" class="form-control">

                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" value="Set" class="btn btn-success btn-sm form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br><br><br><br>
                    <div id="rs">
                        <?php
                        $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("ws", $_SESSION["db_1"]));
                        $row = $result->fetch_assoc();
                        if ((int) $row["rstatus"] == 0) {
                            ?>
                            <h1>Click Button to Start Result</h1>
                            <button class="btn btn-success" onclick="ResultServices(1)"><i class="fa fa-star"></i> Start</button>
                            <?php
                        } else {
                            ?>
                            <h1>Click Button to Stop Result</h1>
                            <button class="btn btn-danger" onclick="ResultServices(0)"><i class="fa fa-stop"></i> Stop</button>

                            <?php
                        }
                        ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>

