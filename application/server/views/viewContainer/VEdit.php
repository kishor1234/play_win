<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-primary">

            <div class="panel-body">
                <legend>Edit ID</legend>
                <div id="diss"></div>
                <?php
                $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("enduser", $_SESSION["db_1"]) . $main->whereSingle(array("userid" => $_REQUEST["uid"])));
                if ($row = $result->fetch_assoc()) {
                    ?>
                    <form action="#" method="post" id="myid" onsubmit="return formPost('#myid', '<?php echo $obj->encdata("C_UpdateID"); ?>', '#diss')">
                        <div class="form-group">
                            <label>User Name <span id="require">*</span></label>
                            <input type="text" name="name" id="name" value="<?php if (isset($row["name"])) {
                    echo $row["name"];
                } ?>" placeholder="Enter Full Name" style="text-transform:uppercase" class="form-control" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Mobile No. <span id="require">*</span></label>
                            <input type="text" name="mobileno" maxlength="10" value="<?php if (isset($row["mobileno"])) {
                    echo $row["mobileno"];
                } ?>" placeholder="Enter Full Name" style="text-transform:uppercase" class="form-control" required="" autocomplete="off">
                            <div class="form-group">
                                <label>Active <span id="require">*</span></label>
                                <select class="form-control" name="is_active" id="is_active">
                                    <?php
                                    if($row["is_active"]==0)
                                    {
                                        ?>
                                    <option value="0" selected>Active</option>
                                    <option value="1">De-Active</option>   
                                    <?php
                                    }else{
                                        ?>
                                    <option value="0">Active</option>
                                    <option value="1" selected>De-Active</option>   
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="hidden" name="userid" id="userid" placeholder="Enter Startup Balance *" class="form-control" value="<?php echo $row["userid"]; ?>" required="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-primary btn-sm">
                            </div>
                    </form>
    <?php
}
?>
            </div>
        </div>
    </div>
</div>
</div>
