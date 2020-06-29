<style>
    .badge{
        font-size: 20px;
    }
</style>
<span><strong>History</strong></span>
<table class="table table-bordered" >
    <tr><th>Draw</th><th>1000</th><th>1100</th><th>1200</th><th>1300</th><th>1400</th><th>1500</th><th>1600</th><th>1700</th><th>1800</th><th>1900</th></tr>
    <?php
    $rsp = $main->adminDB[$_SESSION["db_1"]]->query($main->select("winnumber", $_SESSION["db_1"]) . $main->whereSingle(array("gdate" => date("Y-m-d"))) . $main->orderBy("DESC", "gameid").$main->limitWithOutOffset(1));
    if ($row = $rsp->fetch_assoc()) {
        echo "<tr><td style='font-size:20px;'>" . $row["gameid"] . "</td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["0"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["1"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["2"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["3"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["4"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["5"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["6"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["7"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["8"]) . "</strong></span></td><td><span class='badge'><strong style='font-size:40px;'>" . sprintf("%02d", $row["9"]) . "</strong></span></td></tr>";
    }
    ?>

</table>