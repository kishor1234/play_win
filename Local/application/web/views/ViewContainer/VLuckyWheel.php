<!--<img src="https://i.pinimg.com/originals/97/d7/a9/97d7a95defcfeebbd16da4c378226213.png" style="position: fixed; z-index: -99999; float: left; height: 450px; width: auto; bottom: 45px !important; left: -10px !important;">-->
<center>
    <img src="http://www.pngall.com/wp-content/uploads/2016/06/Om-Free-Download-PNG.png" style="height: 50px; width: auto;">
</center>
<style>
    .bgy{
        background-color: yellow;
    }
    #f2{
        display:none;
    }
    .learg{
        font-size: 100px;
    }
    stong{
        color:#FFF;
        font-size: 20px;
    }

    .input-hidden {
        position: absolute;
        left: -9999px;
    }

    input[type=radio]:checked + label>img {
        border: 1px solid #fff;
        box-shadow: 0 0 3px 3px #090;
    }

    /* Stuff after this is only to make things more pretty */
    input[type=radio] + label>img {
        border-radius: 100%;
        //border: 1px dashed #444;
        width: 90px !important;
        height: 90px !important;
        margin: 5px;
        transition: 500ms all;
    }

    input[type=radio]:checked + label>img {
        transform: 
            rotateZ(-10deg) 
            rotateX(10deg);
    }
</style>
<?php
$sql = $main->select("wheelgtime", $_SESSION["db_1"]) . $main->whereSinglelessthanequal(array("stime" => date("H:i:s"))) . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(1);
$result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
if ($row = $result->fetch_assoc()) {
    $_SESSION["gameidspin"] = $row["id"];
    $_SESSION["stimespin"] = $row["stime"];
    $_SESSION["etimespin"] = $row["etime"];
}
?>

<div class="container">
    <div class="row">

        <div class="col-lg-4">
            <h1><strong>History</strong></h1>
            <br>
            <div id="spinHistory">
                <?php $main->isLoadView("VLuckyWheelResult", false, array()); ?>
            </div>
            <br>
            <img src="http://pngimg.com/uploads/poker/poker_PNG44.png" alt="Image"><br>
            <form action=""  style="display:block;">
                <center>
<!--                <input type="radio" name="point" id="point1" onclick="setPoint(1)"  value="1"> <stong id="points1">1</stong>
<input type="radio" name="point" id="point2" onclick="setPoint(2)"value="2"> <stong id="points2">2</stong>-->
                    <input type="radio" name="point" id="point5" onclick="setPoint(5)" value="5" class="input-hidden"> 
                    <label for="point5">
                        <img 
                            src="5.png" 
                            alt="5" width="150" height="150" />
                    </label>
                    <input type="radio" name="point" id="point10" onclick="setPoint(10)" value="10" class="input-hidden"> 
                    <label for="point10">
                        <img 
                            src="10.png" 
                            alt="10" width="150" height="150"/>
                    </label>
                    <!--<input type="radio" name="point" id="point20" onclick="setPoint(20)" value="20"> <stong id="point20">20</stong>-->
                    <input type="radio" name="point" id="point50" onclick="setPoint(50)" value="50" class="input-hidden"> 
                    <label for="point50">
                        <img 
                            src="50.png" 
                            alt="50" width="150" height="150"/>
                    </label>
                    <input type="radio" name="point" id="point100" onclick="setPoint(100)" value="100" class="input-hidden"> 
                    <label for="point100">
                        <img 
                            src="100.png" 
                            alt="100" width="150" height="150" />
                    </label>
                    <!--<input type="radio" name="point" id="point200" onclick="setPoint(200)" value="200"> <stong id="points200">200</stong>-->
                    <input type="radio" name="point" id="point500" onclick="setPoint(500)" value="500" class="input-hidden"> 
                    <label for="point500">
                        <img 
                            src="500.png" 
                            alt="500" width="150" height="150" />
                    </label>
                </center>
<!--                <input type="radio" name="point" id="point1000" onclick="setPoint(1000)" value="1000"> <stong id="points1000">1000</stong>
                <input type="radio" name="point" id="point2000" onclick="setPoint(2000)" value="2000"> <stong id="points2000">2000</stong>-->
            </form>
            <form action="">
                <input type="radio" name="point" id="point5" onclick="setPoint(5)" value="5"> <stong id="points5">5</stong>
                <input type="radio" name="point" id="point10" onclick="setPoint(10)" value="10"> <stong id="points10">10</stong>
                <input type="radio" name="point" id="point50" onclick="setPoint(50)" value="50"> <stong id="points50">50</stong>
                <input type="radio" name="point" id="point100" onclick="setPoint(100)" value="100"> <stong id="points100">100</stong>
                <input type="radio" name="point" id="point500" onclick="setPoint(500)" value="500"> <stong id="points500">500</stong>
            </form>
        </div>
        <div class="col-lg-4">
            <center>

                <table style="width:100%;"  >
                    <tr>
                        <th style="font-size:20px;">Draw <strong id="gid" class="badge" style="color:#FFF; font-size: 30px;"><?php echo $_SESSION["gameidspin"]; ?></strong></th>
                        <th style="float:right; font-size: 20px;"> Time <strong id="stime" class="badge" style="color:#FFF;font-size: 30px;"><?php echo $_SESSION["etimespin"]; ?></strong></th>
                    </tr>
                </table>

                <div id="chart" style="margin-left: 50px; width:150px;"></div>
                <div id="question" ><h1>2</h1></div>

            </center>

        </div>

        <div class="col-lg-4">
            <center>
                <img src="http://pngimg.com/uploads/poker/poker_PNG44.png" alt="Image">
                <div class="clockSpin" style="margin-left: 50px;"></div>
                <div class="message"></div>
                <br>
                <label><strong>Grand Point Total</strong></label>
                <input type="text" id="gtotal" class="form-control" readonly="">

                <input type="hidden" readonly="" form="tform" class="form-control" id="adarr" name="adarr" value="">
                <span id="aderrd"></span>
                <table>
                    <tr>
                        <td><strong>Total Quantity: <input type="text" form="tform" name="totalpoint" id="totalpoint" class="form-control" required="" ></strong></td>
                        <td><strong>Total Point: <input type="text" form="tform" name="totalamount" id="totalamount" class="form-control" required=""></strong></td>
                    </tr>

                </table>

            </center>
        </div>
    </div>

    <div class="row">
        <div>
                        
            <input type="hidden" id="points" value="<?php
            if (isset($_SESSION["samt"])) {
                echo $_SESSION["samt"];
            } else {
                echo "1";
            }
            ?>">
        </div>
        <div id="f1" >
            <form action="javascript:void(0)" method="post" id="tform">
                <div class="col-lg-12">
                    <table  style="width:100%;"><tr>
                            <?php
                            for ($i = 0; $i < 10; $i++) {
                                ?>
                                <td style="padding:2px;">
                                    <strong>
                                        <center>
                                            <label>
                                                <h1>
                                                    <strong>
                                                        <?php echo $i; ?>
                                                    </strong>
                                                </h1>
                                            </label>
                                        </center>
                                        <input type="text" class=" form-control bgy"  style="text-align: center; font-size: 30px;"  id="p_<?php echo $i; ?>" autocomplete="off" name="p_<?php echo $i; ?>" onmousedown="calclick(event, '#p_<?php echo $i; ?>');
                                                    spincal();
                                                    change(event, '<?php echo $i; ?>')" onkeyup="spincal();
                                                            change(event, '<?php echo $i; ?>')" >
                                    </strong>
                                </td>
                                <?php
                            }
                            ?>
                        </tr> </table>
                </div>
                <div class="col-lg-12">
                    <center>
                        <br>

                        <button type="submit" id="wbt" class="btn btn-success"><i class="fa fa-print"></i> Print</button>
                        <button type="button" class="btn btn-danger" onclick="ResetWheel('#tform')"><i class="fa fa-trash"></i> Reset </button>
                    </center>
                </div>
            </form>
        </div>
        <div id="f2">
            <center>
                <img src="http://www.pamelamoore.net/graphics/ui/loader.gif" alt="Please wait......." height="200px;">
            </center>
        </div>
    </div>
</div>
<script>
    $("document").bind().ready(function (e) {
<?php if (isset($_SESSION["samt"])) {
    ?>
            $("#point<?php echo $_SESSION["samt"]; ?>").attr("checked", true);
            $("#points<?php echo $_SESSION["samt"]; ?>").css("font-size", "30px")
                    .css("color", "red");

    <?php
} else {
    ?>
            $("#point1").attr("checked", true);
<?php }
?>
        var clock;
        var clocksSpin = function (clock, t)
        {
            $('.clockSpin').html("");
            clock = $('.clockSpin').bind().FlipClock(t, {
                clockFace: 'MinuteCounter',
                countdown: true,
                callbacks: {
                    stop: function () {
                        $(this).bind(spinClient(10000));
                        drawSpin();
                        $("#totalpoint").val("");
                        $("#totalamount").val("");
                        $("#gtotal").val("");
                        resetAll("#tform");
                    }
                }
            });

            return false;
        };
        var spinClient = function (d, e) {

            if (d === undefined)
            {
                d = 0;

            }
            //event.stopImmediatePropagation();

            $.post("/?r=<?php echo $obj->encdata("C_SpinWheel"); ?>", {}, function (rups) {

                var obj = jQuery.parseJSON(rups);
                var ps = obj.ps;
                var rng = obj.rng;
                rotation = obj.rotation;
                picked = obj.picked;
                oldrotation = obj.oldrotation;

                var ps = 360 / data.length,
                        pieslice = Math.round(1440 / data.length),
                        //rng = Math.floor((Math.random() * 1440) + 360);

                        rotation = (Math.round(rng / ps) * ps);
                picked = Math.round(data.length - (rotation % 360) / ps);
                picked = picked >= data.length ? (picked % data.length) : picked;

                if (oldpick.indexOf(picked) !== -1) {
                    d3.select(this).call(spinClient);
                    return;
                }
                rotation += 90 - Math.round(ps / 2);
                vis.transition()
                        .duration(d)
                        .attrTween("transform", rotTween)
                        .each("end", function () {
                            d3.select(".slice:nth-child(" + (picked + 1) + ") path");
                            d3.select("#question h1")
                                    .text(data[picked].question);

                            oldrotation = rotation;
                            if (d !== 0) {
                                $("#middleSpin").html(data[picked].question);
                            }
                            container.on("click", spinClient);
                        });
                function rotTween(to) {
                    var i = d3.interpolate(oldrotation % 360, rotation);
                    return function (t) {
                        //playSound();
                        return "rotate(" + i(t) + ")";
                    };
                }

            });

            return false;
        };
        var drawSpin = function ()
        {
            $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRoundSpin"); ?>", {}, function (data) {
                var obj = jQuery.parseJSON(data);
                $("#gid").html(obj.id);
                $('#stime').html(obj.etime);
                //alert(obj.etime);
                $("#etime").html(obj.etime);
                clocksSpin(clock, obj.time);
                setTimeout(resultSpin, 11000);
            });

        };
        var resultSpin = function ()
        {
            $.post("/?r=<?php echo $obj->encdata("C_SpinResult"); ?>", {}, function (dat) {
                $("#spinHistory").html(dat);
                $.post("/?r=<?php echo $obj->encdata("C_LuckyWheelAdvanceDrawChart"); ?>", {}, function (d) {
                    $("#lwheelad").html(d);
                });
            });

        };
        var resetAll = function (id)
        {
            $(id)[0].reset();
            clearBtn();
            clearpad();
            for (var i = 0; i < 100; i++)
            {
                $("#e_0_" + pn(i)).attr("class", "form-control bgw");
            }
            $("#gtotal").val("");
            $("#adarr").val("");
            $("#totalpoint").val("");
            $("#totalamount").val("");
            $("#totalqty_0").val("");
            $("#totalamt_0").val("");
            $("#fp").prop("checked", false);
            for (var j = 10; j < 20; j++)
            {
                $("#selectDraw_" + j).attr("checked", false);
            }

            return false;
        };
        $("body").on("contextmenu", function (e) {
            return true;
        });
        $(this).bind("load", spinClient());
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRoundSpin"); ?>", {}, function (data) {
            //alert(data);    
            var obj = jQuery.parseJSON(data);
            $("#gid").html(obj.id);
            $('#stime').html(obj.etime);
            $("#etime").html(obj.etime);
            clocksSpin(clock, obj.time);
        });

        $(this).bind("load", setInterval(function () {
            $.post("/?r=<?php echo $obj->encdata("C_Check30SecSpin"); ?>", {}, function (data) {
                if (data.localeCompare("1") === 0)
                {
                    $("#f1").hide();
                    $("#f2").show();
                    console.log("Data " + data);

                }
                else {


                    $("#f1").show();
                    $("#f2").hide();
                    console.log("Data " + data);
                }
            });
        }, 1000));
        var changedrawSpin = function (dtime)
        {

            $.post("/?r=<?php echo $obj->encdata("C_AdvanceDrawSpin"); ?>", {id: $(dtime).val()}, function (data) {
                var obj = jQuery.parseJSON(data);
                $("#gid").html(obj.id);
                $('#stime').html(obj.stime);
                $("#etime").html(obj.etime);
                $("#aderr").html(obj.msg);
            });
        };
        var printInvoiceSpin = function (id, file, display) {
            var formData = new FormData($(id)[0]);
            //onLoading();
            var amt = 0;
            for (i = 0; i < 10; i++) {
                var v = parseInt($("#p_" + i).val());
                if (isNaN(v)) {
                    v = 0;
                }
                var p = v * 2;
                amt = amt + p;
            }
            $("#wbt").html("<i class='fa fa-print'></i> Please Wait....");
            $("#wbt").attr("type", "button");

            $.post("/?r=<?php echo $obj->encdata("C_CheckBalance"); ?>", {amt: $("#totalamount").val(), ad: $("#adarr").val()}, function (d) {

                if (d.localeCompare("0") == 0)
                {
                    $.ajax({
                        type: "POST",
                        url: '/?r=' + file,
                        data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
                        contentType: false,
                        processData: false,
                        success: function (data)
                        {


                            resetSpinClock();
                            $("#totalpoint").val("");
                            $("#totalamount").val("");
                            $("#gtotal").val("");
                            resetAll(id);
                            $.post("/?r=<?php echo $obj->encdata("C_GetLastLuckyWheelTicket"); ?>", {}, function (dat) {
                                //alert(dat);
                                $("#C_LuckyWheel").html(dat);
                                $.post("/?r=<?php echo $obj->encdata("C_GetLastCancelWheel"); ?>", {}, function (dat) {
                                    //alert(dat);
                                    $("#C_LuckyWheelC").html(dat);

                                });
                                $("#wbt").html("<i class='fa fa-print'></i> Print");
                                $("#wbt").attr("type", "submit");
                                Popups2(data);

                            });

                        }

                    });
                }
                else {
                    $("#wbt").html("<i class='fa fa-print'></i> Print");
                    $("#wbt").attr("type", "submit");
                    $("#dips").html("<h3 style='color:#FFF;'>Insuficent Fund..</h3>");
                    $("#loading").modal('toggle');

                }

            });
            return false;
        };
        function Popups2(data) {
            var mywindow = window.open();
            mywindow.document.write(data);
            setTimeout(function () {
                console.log("Set");
                mywindow.print();
                mywindow.close();
                location.reload();
            }, 100);


            return true;
        }

        $("#tform").submit(function (e) {
            e.stopPropagation();
            var id = "#tform";
            var file = "<?php echo $obj->encdata("C_PrintInvoiceSpin"); ?>";
            var display = "#display";
            printInvoiceSpin(id, file, display);
        });
        var clearBtn = function ()
        {
            for (var i = 10; i < 20; i++)
            {
                $("#btn_" + i).val("");
            }
        };
        var clearpad = function () {
            for (var i = 0; i < 100; i++)
            {
                $("#e_0_" + pn(i)).val("");
            }
            for (var i = 0; i < 100; i = i + 10)
            {
                $("#row_0_" + i).val("");

            }
            for (var i = 0; i < 10; i++)
            {
                $("#col_0_" + i).val("");

            }
        };
        var ResetWheel = function (id)
        {
            $("#totalpoint").val("");
            $("#totalamount").val("");
            $("#gtotal").val("");
            resetAll(id);
        };
        var resetSpinClock = function () {
            $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRoundSpin"); ?>", {}, function (data) {
                var obj = jQuery.parseJSON(data);
                $("#gid").html(obj.id);
                $("#stime").html(obj.etime);
                $("#etime").html(obj.etime);
                clocksSpin(clock, obj.time);


            });
        };

    });

</script>

