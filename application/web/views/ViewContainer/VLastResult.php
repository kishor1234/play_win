<style>
    .badge{
        font-size: 30px;
    }
</style>
<table class="table table-bordered">
    <?php
    $rsp = $main->adminDB[$_SESSION["db_1"]]->query($main->select("winnumber", $_SESSION["db_1"]) . $main->whereSingle(array("gdate" => date("Y-m-d"))) . $main->orderBy("DESC", "gameid").$main->limitWithOutOffset(1));
    if ($row = $rsp->fetch_assoc()) {
        echo "<tr><th>" . $row["gameid"] . "</th><th>NUM</th></tr>";
        $sona = 10;
        for ($i = 0; $i < 10; $i++) {
            echo "<tr><th>" . $sona . "</th><td><span class='badge'><strong>" . sprintf("%02d", $row[$i]) . "</strong></span></td></tr>";
            $sona++;
        }
    }
    ?>
</table>
<a href="#" class="btn btn-success btn-xs" onclick="printLastResult()"><i class="fa fa-print"> Last Result</i></a>