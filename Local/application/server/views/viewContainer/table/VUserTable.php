<div class="col-lg-12" style="overflow: auto;">
    <table class="table table-hover table-responsive table-bordered">

        <tr>
            <th>ID</th>
            <th>Account No</th>
            <th>Name</th>
            <th>Mobile No</th>
            <th>Point's</th>
            <th>Action</th>
            <th>IP</th>
        </tr>

        <?php
        $sql = $main->select("enduser", $_SESSION["db_1"]) . $main->whereSingleLikeAndArray(array("name" => $_POST["id"]),array("is_active"=>0)) . $main->limitWithOutOffset(10);
        $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
        $i = 0;
        $main->isLoadView("VUserTableData",false,array("result"=>$result,"i"=>0));
                    
        ?>


    </table>
</div>
