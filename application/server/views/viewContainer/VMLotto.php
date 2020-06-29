
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-5">
            <div id="dp"></div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">Lotto Set Result</h2>
                </div>
                <div class="box-body">
                    <form action="javascript:void(0)" method="post" class="form-horizontal" onsubmit="return formPost('#myid', '<?php echo $obj->encdata("C_SetLotoResult"); ?>', '#dp')" id="myid">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label><strong>Select Draw</strong>*</label>
                                <input type="text" id="gameid" list="did" required onkeyup="getDrawLoto('#gameid', '#did')" name="gameid" class="form-control">
                                <datalist id="did">
                                    <?php
                                    $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("gametime", $_SESSION["db_1"]));
                                    while ($row = $result->fetch_assoc()) {
                                        echo"<option>" . $row["id"] . "|" . $row["stime"] . "|" . $row["etime"] . "" . "</option>";
                                    }
                                    ?>
                                </datalist>
                            </div>
                            <div class="col-lg-12">
                                <label><strong>Start Time</strong>*</label>
                                <input type="text" id="stime" name="stime" required readonly="" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label><strong>End Time</strong>*</label>
                                <input type="text" id="etime" name="etime" required="" readonly="" class="form-control">
                            </div><div class="col-lg-12">
                                <label>&nbsp;</label>
                            </div><br><br><br>
                            <div class="col-lg-1">
                                &nbsp;
                            </div>
                            <?php
                            for ($i = 0; $i < 10; $i++) {
                                ?>
                                <div class="col-lg-1">
                                    <label id="label label-primary" style="margin-left:15px;"><strong><?php echo $i; ?></strong>*</label>
                                    <input required style="height:20px; width:40px; margin:1px; padding:1px; border-radius: 5px; text-align:center; border-color: #FFAAD2; color:red; font-size: 20px;" type="text" maxlength="2" onkeypress="return isNumber(event)" name="<?php echo $i; ?>" id="<?php echo $i; ?>" class="form-control">
                                </div>

                                <?php
                            }
                            ?>
                            <div class="col-lg-1">
                                &nbsp;
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
        <div class="col-lg-7">
            <legend>Total Load of Selected Draw</legend>
            <div id="display" style="overflow: auto;">
               
            </div>
        </div>
    </div>
</div>

