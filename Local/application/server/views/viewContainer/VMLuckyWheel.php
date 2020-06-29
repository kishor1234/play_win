
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div id="dp"></div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Lucky Wheel Set Result</h2>
                </div>
                <div class="box-body">
                    <form action="#" method="post" onsubmit="return formPost('#myid', '<?php echo $obj->encdata("C_SetLuckyWheelResult"); ?>', '#dp')" id="myid">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label>Select Draw</label>
                                <input type="text" id="gameid" list="did" onkeyup="getDraw('#gameid','#did')" name="gameid" class="form-control">
                                <datalist id="did">
                                    <?php
                                    $result=$main->adminDB[$_SESSION["db_1"]]->query($main->select("wheelgtime",$_SESSION["db_1"]));
                                    while($row=$result->fetch_assoc())
                                    {
                                        echo"<option>".$row["id"]."|".$row["stime"]."|".$row["etime"].""."</option>";
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="col-lg-12">
                                <label>Start Time</label>
                                <input type="text" id="stime" name="stime" readonly="" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label>End Time</label>
                                <input type="text" id="etime" name="etime" readonly="" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label>Win Number</label>
                                <input type="text" id="picked" name="picked" maxlength="1"  class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label>&nbsp;</label>
                                <input type="submit"  class="btn btn-success bnt-sm form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>
</div>

