<br><br>

<div class="row">
    <div class="col-lg-7" style='max-height:400px;overflow-y:auto;'>
        <?php
        if (isset($_POST["gdate"])) {
            $sql = $main->select("winnumber", $_SESSION["db_1"]) . $main->whereSingle($_POST) . $main->orderBy("ASC", "gameid");
            $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
            //echo "Data<br>";die;

            echo"<table class='table table-bordered' >";
            echo "<tr><th>Draw</th><th>1000</th><th>1100</th><th>1200</th><th>1300</th><th>1400</th><th>1500</th><th>1600</th><th>1700</th><th>1800</th><th>1900</th><th>Total Load</th><th>80Per</th><th>Action</th></tr>";
            $j = 1;
            while ($row = $result->fetch_assoc()) {
                if ($j == $row["gameid"]) {
                    echo "<tr id='$j'>";
                    echo "<td><strong>" . $row["gameid"] . "</strong></td>";
                    for ($i = 0; $i < 10; $i++) {
                        echo "<td>" . sprintf("%02d", $row[$i]) . "</td>";
                    }
                    echo "<td>" . $row["dload"] * 2 . "</td>";
                    echo "<td>" . $row["80per"] * 2 . "</td>";
                    echo "<td><span class='btn btn-success btn-xs'>Result Decleared</span><br><br>"
                    . "<a href='javascript:void(0)' class='btn btn-default btn-xs' onclick=\"return viewData('" . $j . "','#displayDraw','" . $row["id"] . "')\" >View Draw Point<a></td>";
                    echo "</tr>";
                    $j++;
                } else {
                    while ($j != $row["gameid"] && $j<=145) {
                        echo "<tr id='$j'>";
                        echo "<td><strong>" . $j . "</strong></td>";
                        for ($i = 0; $i < 10; $i++) {
                            echo "<td>&nbsp;</td>";
                        }
                        if (strtotime($_POST["gdate"]) == strtotime(date("Y-m-d"))) {
                            echo "<td>&nbsp;</td>";
                            echo "<td>&nbsp;</td>";
                            echo "<td><a href='javascript:void(0)' onclick=\"GetResultLoto('#" . $j . "','" . $obj->encdata("C_GetLuckyNumbersapi_1") . "&t=0" . "','" . $j . "') \" class=\"btn btn-primary btn-xs\">Set Result AUT</a><br><br>"
                            . "</td>";
                        }else{
                            
                        }

                        $j++;
                        echo "</tr>";
                    }
                    if ($j == $row["gameid"]) {
                        echo "<tr id='$j'>";
                        echo "<td><strong>" . $row["gameid"] . "</strong></td>";
                        for ($i = 0; $i < 10; $i++) {
                            echo "<td>" . sprintf("%02d", $row[$i]) . "</td>";
                        }
                        echo "<td>" . $row["dload"] * 2 . "</td>";
                        echo "<td>" . $row["80per"] * 2 . "</td>";
                        echo "<td><span class='btn btn-success btn-xs'>Result Decleared</span><br><br>"
                        . "<a href='javascript:void(0)' class='btn btn-default btn-xs' onclick=\"return viewData('" . $j . "','#displayDraw','" . $row["id"] . "')\" >View Draw Point<a></td>";
                        echo "</tr>";
                        $j++;
                    }
                }
            }
            echo "</table>";
        } else {

            echo $main->printMessage("Invalide Date Data...!", "danger");
        }
        ?>
    </div>
    <div class="col-lg-5" style='max-height:400px;overflow-y:auto;'>
        <legend>View Data</legend>
        <div id="displayDraw" >

        </div>
    </div>
</div>