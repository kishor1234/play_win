<style>
    td{
        font-size: 30px;
    }
</style>
<div class="row">
    <div class="col-lg-6 col-lg-offset-3" style='max-height:400px;overflow-y:auto;'>
        <?php
        
            $sql = $main->select("wheelwiner", $_SESSION["db_1"]) . $main->whereSingle(array("cdate"=>$tdate)) . $main->orderBy("ASC", "gameid");
            $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
            echo"<table class='table table-bordered' >";
            echo "<tr><th>Game ID</th><th>Lunky No</th><th>Draw Time</th></tr>";
            $j = 1;

            while ($row = $result->fetch_assoc()) {
                // echo $row["gameid"];die;
               
                    echo "<tr id='$j'>";
                    echo "<td>" . $j . "</td>";
                    echo "<td>" . $row["picked"] . "</td>";
                    echo "<td>" . $row["etime"] . "</td>";
                    //echo "<td>" . $row["dload"] . "</td>";
                    //echo "<td>" . $row["80per"] . "</td>";
                    echo "</tr>";
                    $j++;
                
            }
            echo "</table>";
        
        ?>
    </div>
    
</div>