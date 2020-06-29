
<section class="content-header">
    <h1>
        Get Back Balance
        <small>Point</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
        <li class="active">User Details</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div id="dismsg">

    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <?php
                    if (isset($_REQUEST["uid"])) {
                        $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("enduser", $_SESSION["db_1"]) . $main->where(array("userid" => $_REQUEST["uid"], "is_active" => 0), "AND"));
                        if ($row = $result->fetch_assoc()) {
                            extract($row);
                            ?>
                            <form action="#" method="post" id="sendBal" onsubmit="return formPost3('#sendBal','<?php echo $obj->encdata("C_GetBackBalance");?>','#dismsg')">
                                <div class="form-group">
                                    <label>User ID <span id="require">*</span></label>
                                    <input type="text" name="userid" id="userid" readonly="" required="" value="<?php echo $userid; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Name <span id="require">*</span></label>
                                    <input type="text" readonly="" required="" value="<?php echo $name; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number <span id="require">*</span></label>
                                    <input type="text" readonly="" required="" value="<?php echo $mobileno; ?>" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>User Balance <span id="require">*</span></label>
                                    <input type="text"  required="" value="<?php echo $balance; ?>" readonly="" name="oldbalance" id="oldnalance" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Enter Amount <span id="require">*</span></label>
                                    <input type="number" name="balance" id="balance" required="" class="form-control" value="1" onkeyup="checkMainBalance()">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Get Back Balance" class="btn btn-success btn-sm">
                                </div>
                            </form>
                            <?php
                        } else {
                            echo $main->printMessage("Invalid User ID..", "danger");
                        }
                    } else {
                        echo $main->printMessage("Invalid User ID..", "danger");
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkMainBalance()
        {
            var main=parseFloat($("#bal").html());
            var point=parseFloat($("#balance").val());
            if(main<point)
            {
                alert("Insuficient Balance.. try to update main balance....");
                $("#balance").val("0");
            }
            return false;
        }
        </script>

</section><!-- /.content -->
