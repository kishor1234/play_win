<style>
    .bgy{
        background-color: yellow;
    }

    tr td{
        padding: 1px !important;
        margin: 1px !important;

    }
    .badgess{
        color: #F2F2F0;
        background-color: #162238;

        width: 25px;
        height: 20px;
        padding-top: 5px;
        box-shadow: 0px 0px 10px 1px #707F8C;
    }
    #display{
        
        z-index: 90;
        height: 100px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    #tabr{
        width: 80%;
        height: 10px;
    }


    #tabr tr th{
        border: 1px solid #000;
    }
    #tabr tr td{
        border: 1px solid #000;
    }
    #w1{
        display: none;
        height: 400px;
    }
    #w2{display: none;
        height:400px}
    .clock {
        position: relative !important;
        padding-top: 0px;
        margin-left: -160px;
        height:100px;
        width: 800px;
        zoom: 1.5;
        transform: scale(.54);
        -ms-transform: scale(.54); /* IE 9 /
        -webkit-transform: scale(.54); / Safari and Chrome /
        -o-transform: scale(.54); / Opera /
        -moz-transform: scale(.54); / Firefox */
    }

    .flip-clock-wrapper {
        position: relative;
    }


</style>
<center>
    <img src="om.png" style="height: 50px; width: auto;">
</center>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img id="w1" src="https://i.pinimg.com/originals/49/8f/77/498f7727ecf2a588d6c3eebac92a7c4b.gif">
            <form id="myform" action="#" name="myform" onsubmit="return printInvoice('#myform', '<?php echo $obj->encdata("C_PrintInvoice"); ?>', '#display')" method="post">

                <table class="table table-bordered table-responsive " >

                    <tr>

                        <td>
                            <a href="javascript:void(0)" style="height:30px;" class="btn btn-default btn-xs form-control" onclick="select('#selectyn', 'false');" id="selectyn" >SELECT ALL</a>
                        </td>
                        </td>
                        <td>
                            <span class="btn btn-default btn-xs form-control" style="height:30px;" >SELECTED</span>
                        </td>
                        <td>
                            <span class="btn btn-default btn-xs form-control" style="height:30px;" >QTY</span>
                        </td>
                        <td>
                            <span class="btn btn-default btn-xs form-control" style="height:30px;"   >PNT</span>
                        </td>
                    </tr>
                    <?php
                    for ($i = 10; $i < 20; $i++) {
                        ?>
                        <tr>
                            <td>
                                <div class="btn btn-primary btn-sm" style="height: 30px;">
                                    <label class="con" style="margin-top: -7px;"><?php echo $i . "00-" . $i . "99"; ?>
                                        <input type="checkbox" id="selectDraw_<?php echo $i; ?>" name="selectDraw_<?php echo $i; ?>">
                                        <span class="checkmark" style="margin-top: 1px;"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <input type="button" class="btn btn-default btn-xs form-control" style="height:28px;"  id="btn_<?php echo $i; ?>"  onclick="openDraw('<?php echo $i; ?>')">
                                <!-- Modal -->
                                <div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Plates <?php
                                                    echo ($i * 100);
                                                    echo "-";
                                                    echo ($i * 100) + 99;
                                                    ?></h4>
                                            </div>
                                            <div class="modal-body">

                                                <table class="table table-bordered" >
                                                    <?php
                                                    $mid = $i * 100;
                                                    $k = 0;
                                                    echo "<tr><td></td>";

                                                    for ($j = 0; $j < 10; $j++) {
                                                        echo "<td>";

                                                        echo '<input type="text" maxlength="3" onkeypress="return isNumberKey(event)" id="col_' . $mid . '_' . $j . '" class="form-control " style="height:20px; width:40px; margin:1px; padding:1px; border-radius: 5px; background-color:#86ABFF; color:#FFF; text-align:center;" onkeyup="addcol(' . $j . ',' . $mid . '); movecol(event,' . $mid . ',' . $j . ');">';
                                                        echo "</td>";
                                                    }
                                                    echo "</tr>";
                                                    $p = 0;
                                                    for ($c = 0; $c < 10; $c++) {
                                                        echo "<tr>";
                                                        echo "<td>";
                                                        echo "<center>&nbsp;</center>";
                                                        echo '<input type="text" maxlength="3" onkeypress="return isNumberKey(event)" id="row_' . $mid . '_' . $p . '" class="form-control " style="height:20px; width:40px; margin:1px; padding:1px; border-radius: 5px; background-color:#86ABFF; color:#FFF; text-align:center;" onkeyup="addrow(' . $p . ',' . $mid . ');moverow(event,' . $mid . ',' . $p . ');">';
                                                        echo "</td>";
                                                        $p = $p + 10;
                                                        for ($j = 0; $j < 10; $j++) {
                                                            echo "<td>";
                                                            echo "<center><strong>" . sprintf("%02d", $k) . "</strong></center>";
                                                            echo '<input type="text" maxlength="3" onkeypress="return isNumberKey(event)" id="e_' . $mid . '_' . sprintf("%02d", $k) . '" name="e_' . $mid . '_' . sprintf("%02d", $k) . '" class="form-control " style="height:20px; width:40px; margin:1px; padding:1px; border-radius: 5px; text-align:center; border-color: #FFAAD2; color:red;" onkeyup="calNumber(' . $mid . '); checkfp(' . $mid . ',' . sprintf("%02d", $k) . '); move(event,' . $mid . ',' . sprintf("%02d", $k) . ')">';
                                                            echo "</td>";
                                                            $k++;
                                                        }
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </table>
                                                <table class="table">
                                                    <tr>
                                                        <td><label><br></label>
                                                            <input type="button" value="Submit" data-dismiss="modal" class="btn btn-primary btn-sm form-control" onclick="drawsubmit('<?php echo $mid; ?>')" ></td>
                                                        <td><label><br></label>
                                                            <input type="button" value="Clear"  onclick="clearAll('<?php echo $mid; ?>')" class="btn btn-primary btn-sm form-control"></td>
                                                        <td style="width:100px;">
                                                            <label>Total Qty</label>
                                                            <input type="text"  id="totalqty_<?php echo $mid; ?>" name="totalqty_<?php echo $mid; ?>"  class=" form-control"  ></td>
                                                        <td style="width:100px;">
                                                            <label>Total PNT</label>
                                                            <input type="text" id="totalamt_<?php echo $mid; ?>" name="totalamt_<?php echo $mid; ?>" class="form-control" ></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </td>
                            <td>
                                <input type="hidden" name="sel_<?php echo $i; ?>" id="sel_<?php echo $i; ?>">
                                <input type="text" class="form-control" id="qty_<?php echo $i; ?>" name="qty_<?php echo $i; ?>" style="width:40px; height: 28px; padding: 0px;"  disabled>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="amt_<?php echo $i; ?>" name="amt_<?php echo $i; ?>" style="width:40px; height: 28px; padding: 0px;" disabled>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td><input type="submit" value="Print" id="sbtn" class="btn btn-warning btn-sm form-control" style="height: 28px; padding-bottom:  20px;"></td>
                        <td><input type="button" class="btn btn-danger btn-xs form-control" onclick="resetAll('#myform');" value="Reset" style="height: 28px;"></td>
                        <td><input type="text"  class="form-control" id="tqty" name="tqty" style="width:40px; height: 28px; padding: 0px;" required=""></td>
                        <td><input type="text"  class="form-control" id="tamt" name="tamt" style="width:40px; height: 28px; padding: 0px;" required=""></td>
                    </tr>
                </table>

            </form>
            <input type="checkbox" id="fp" name="fp">FP

            <br>

            <label><strong>Grand Point Total</strong></label>
            <input type="text" id="gtotal" class="form-control" readonly="">
            <input type="hidden" readonly="" form="myform" class="form-control" id="adarr" name="adarr" value="">
            <span id="aderrd"></span>


        </div>
        <div class="col-lg-1" id="hrpoint">

            <?php
            $main->isLoadView("VLastResult", false, array());
            ?>

        </div>
        <div class="col-lg-5">
            <img id="w2" src="https://i.pinimg.com/originals/49/8f/77/498f7727ecf2a588d6c3eebac92a7c4b.gif">
            <div id="dpad">
                <table class="table table-bordered table-responsive">
                    <?php
                    $mid = 0000;
                    $k = 0;

                    echo "<tr><td></td>";
                    for ($j = 0; $j < 10; $j++) {
                        echo "<td>";
                        echo '<input type="text" maxlength="3" id="col_' . $mid . '_' . $j . '" class="form-control " style="height:20px; width:40px; margin:1px; padding:1px; font-size: 20px; border-radius: 5px; background-color:#86ABFF; color:#FFF; text-align:center;" onkeyup="addcol(' . $j . ',' . $mid . ');movecol(event,' . $mid . ',' . $j . ');" onkeypress="return isNumberKey(event)"/>';
                        echo "</td>";
                    }
                    echo "</tr>";
                    $p = 0;
                    for ($c = 0; $c < 10; $c++) {
                        echo "<tr>";
                        echo "<td>";
                        echo "<center>&nbsp;</center>";
                        echo '<input type="text" maxlength="3" id="row_' . $mid . '_' . $p . '" class="form-control " style="height:20px; width:40px; margin:1px; padding:1px; border-radius: 5px; background-color:#86ABFF; color:#FFF; font-size: 20px; text-align:center;" onkeyup="addrow(' . $p . ',' . $mid . ');moverow(event,' . $mid . ',' . $p . ');" onkeypress="return isNumberKey(event)"/>';
                        echo "</td>";
                        $p = $p + 10;
                        for ($j = 0; $j < 10; $j++) {
                            echo "<td>";
                            echo "<center><strong>" . sprintf("%02d", $k) . "</strong></center>";
                            echo '<input type="text" maxlength="3" id="e_' . $mid . '_' . sprintf("%02d", $k) . '" name="e_' . $mid . '_' . sprintf("%02d", $k) . '" class="form-control " style="height:20px; width:40px; margin:1px; padding:1px; border-radius: 5px; text-align:center; border-color: #FFAAD2; color:red; font-size: 20px;" onkeyup="calNumber2(event,' . $mid . '); checkfp(' . $mid . ',' . sprintf("%02d", $k) . ');move(event,' . $mid . ',' . sprintf("%02d", $k) . ')" onkeypress="return isNumberKey(event)"/>';
                            echo "</td>";
                            $k++;
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>

            </div>

        </div>
        <div class="col-lg-3">
            <center>
                <?php
                $sql = $main->select("gametime", $_SESSION["db_1"]) . $main->whereSinglelessthanequal(array("stime" => date("H:i:s"))) . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(1);
                $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
                if ($row = $result->fetch_assoc()) {
                    $_SESSION["gameid"] = $row["id"];
                    $_SESSION["stime"] = $row["etime"];
                    $_SESSION["etime"] = $row["etime"];
                }
                ?>
                <table class="table">
                    <tr>
                        <th style="font-size:15px;">Draw <strong  class="badge" style="color:#FFF"><span id="gid" style='font-size:20px;'><?php echo $_SESSION["gameid"]; ?></span></strong></th>
                        <th style="float:right; font-size: 15px;"> Time <strong class="badge" style="color:#FFF"><p id="stime" style='font-size:20px;'><?php echo $_SESSION["stime"]; ?></p></strong></th>
                    </tr>
                </table>
                <canvas id="canvas" style="margin-top:-25px; margin-left: 50px"></canvas>
                <div class="clock"></div>
                <table class="table table-bordered table-responsive " style="margin-top:-10px; margin-left: 20px">
                    <tr>
                        <td><label><br></label>
                            <input type="button" value="Submit" data-dismiss="modal" class="btn btn-primary btn-xs form-control" style="height:30px;" onclick="drawsubmitDTOP('<?php echo $mid; ?>')"></td>
                        <td><label><br></label>
                            <input type="button" value="Clear"  onclick="clearAll('<?php echo $mid; ?>')" class="btn btn-primary btn-xs form-control" style="height:30px;"></td>
                        <td style="width:100px;">
                            <label>Total Qty</label>
                            <input type="text"  id="totalqty_<?php echo $mid; ?>" name="totalqty_<?php echo $mid; ?>"  class=" form-control"  style="height:30px; font-size: 25px;"></td>
                        <td style="width:100px;">
                            <label>Total PNT</label>
                            <input type="text" id="totalamt_<?php echo $mid; ?>" name="totalamt_<?php echo $mid; ?>" class="form-control"style="height:30px; font-size: 25px;" ></td>
                    </tr>
                </table>
                <div class="message"></div>
            </center>


        </div>

    </div>


</div>
<div class="container-fluid">
    <div class="row">

        <div class="col-lg-7">
            <div id="result">
                <?php
                $main->isLoadView("VLastLotoResult", false, array());
                ?>
            </div>
        </div>
        <div class="col-lg-5">
            <span><strong>Result History</strong></span>
            
            <div id="display">
                <?php $main->isLoadView("VResult", false, array()); ?>
            </div>
        </div>

    </div>
</div>
<script>

    $(document).ready(function () {
        callCanvas();
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRound"); ?>", {}, function (data) {

            var obj = jQuery.parseJSON(data);
            $("#gid").html(obj.id);
            $('#stime').html(obj.etime);
            $("#etime").html(obj.etime);
            clocks(clock, obj.time);
        });

        setInterval(function () {
            $.post("/?r=<?php echo $obj->encdata("C_Check30Sec"); ?>", {}, function (data) {
                if (data.localeCompare("1") === 0)
                {
                    $("#myform").hide();
                    $("#dpad").hide();
                    $("#hrpoint").hide();
                    $("#w2").show();
                    $("#w1").show();
                    //console.log("Data " + data);
                }
                else {
                    $("#myform").show();
                    $("#dpad").show();
                    $("#hrpoint").show();
                    $("#w2").hide();
                    $("#w1").hide();
                    //console.log("Data " + data);
                }
            });
        }, 1000);
    });
    function changedraw(dtime)
    {

        $.post("/?r=<?php echo $obj->encdata("C_AdvanceDraw"); ?>", {id: $(dtime).val()}, function (data) {
            var obj = jQuery.parseJSON(data);
            //alert(data);
            $("#gid").html(obj.id);
            $('#stime').html(obj.etime);
            $("#etime").html(obj.etime);
            $("#aderr").html(obj.msg);
        });
    }
</script>

