<br><br>

<div class="row">
    <div class="col-lg-7" style='max-height:400px;overflow-y:auto;'>
        <?php
        if (isset($_POST["cdate"])) {
            $sql = $main->select("wheelwiner", $_SESSION["db_1"]) . $main->whereSingle($_POST) . $main->orderBy("ASC", "gameid");
            $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
            echo"<table class='table table-bordered' >";
            echo "<tr><th>Game ID</th><th>Lunky No</th><th>Draw Time</th><th>Load</th><th>80%</th><th>Action</th></tr>";
            $j = 1;

            while ($row = $result->fetch_assoc()) {
                // echo $row["gameid"];die;
                if ($j == $row["gameid"]) {
                    echo "<tr id='$j'>";
                    echo "<td>" . $j . "</td>";
                    echo "<td>" . $row["picked"] . "</td>";
                    echo "<td>" . $row["etime"] . "</td>";
                    echo "<td>" . $row["dload"] . "</td>";
                    echo "<td>" . $row["80per"] . "</td>";
                    echo "<td><span class='btn btn-success btn-xs'>Result Decleared</span><br><br>"
                    . "<a href='#' class='btn btn-default btn-xs' onclick=\"return viewDataLucky('" . $j . "','#displayDraw','" . $row["id"] . "')\" >Set Result MUL<a></td>";
                    echo "</tr>";
                    $j++;
                } else {
                    while ($j != $row["gameid"]&&  $j<=144) {
                        echo "<tr id='$j'>";
                        echo "<td>" . $j . "</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                        if (strtotime($_POST["cdate"]) == strtotime(date("Y-m-d"))) {
                            echo "<td><a href='javascript:void(0)' onclick=\"GetResultLucky('#" . $j . "','" . $obj->encdata("C_LuckyWheelServerResultapi") . "&t=0" . "','" . $j . "') \" class=\"btn btn-primary btn-xs\">Set Result AUT</a><br><br>"
                            . "</td>";
                            echo "</tr>";
                        }

                        $j++;
                    }
                    if ($j == $row["gameid"]) {
                        echo "<tr id='$j'>";
                        echo "<td>" . $j . "</td>";
                        echo "<td>" . $row["picked"] . "</td>";
                        echo "<td>" . $row["etime"] . "</td>";
                        echo "<td>" . $row["dload"] . "</td>";
                        echo "<td>" . $row["80per"] . "</td>";
                        echo "<td>&nbsp;</td>";
                        echo "</tr>";
                        $j++;
                    }
                }
            }
            echo "</table>";
        } else {

            echo $main->printMessage("Invalide Date Data...! ", "danger");
        }
        ?>
    </div>
    <div class="col-lg-5" style='max-height:400px;overflow-y:auto;'>
        <legend>View Data</legend>
        <div id="displayDraw" >

        </div>
    </div>
</div>