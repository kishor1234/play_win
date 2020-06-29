<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: transparent;
    }

    li {
        float: left;
        padding-left: 0px !important;
        
    }
    .li {
        float: left;
        padding-left: 0px !important;
        border: 1px solid #FFF;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #111111;
    }

</style>


<div  class="form-group form-horizontal" style="padding: 0px; margin: 0px;"> 
    <?php
    $even = "";
    $odd = "";
    $fl = false;
    $evenarray = array();
    $oddarray = array();
    $i = 0; // = $main->getData("SELECT * FROM `ws`","id"); //0==left 1==right
    if ($i == 0) {
        //$color = array(0 => "#1f77b4", 1 => "#aec7e8", 2 => "#ff7f0e", 3 => "#ffbb78", 4 => "#2ca02c", 5 => "#98df8a", 6 => "#d62728", 7 => "#ff9896", 8 => "#9467bd", 9 => "#c5b0d5");
        $color = array(0 => "#3182bd", 1 => "#6baed6", 2 => "#9ecae1", 3 => "#c6dbef", 4 => "#e6550d", 5 => "#fd8d3c", 6 => "#fdae6b", 7 => "#fdd0a2", 8 => "#31a354", 9 => "#74c476");
        $sql = $main->select("wheelgtime", $_SESSION["db_1"]) . "WHERE etime<='" . date("H:i:s") . "' " . $main->orderBy("DESC", "id") . $main->limitWithOutOffset(15);

        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        echo "<ul>";
        echo "<li class='li'><span class=\"btn btn-0\" style=\" background-color:" . $color[4] . " ;  \"><span style=\"color:#FFF; text-align: center; font-size: 30px; \">&nbsp;&nbsp;</span></span></li>";
        while ($row = $result->fetch_assoc()) {
            $resutl2 = $main->adminDB[$_SESSION["db_1"]]->query($main->select("wheelwiner", $_SESSION["db_1"]) . $main->where(array("cdate" => date("Y-m-d"), "gameid" => $row["id"]), "AND") . $main->orderBy("DESC", "gameid") . $main->limitWithOutOffset(1));
            if ($row2 = $resutl2->fetch_assoc()) {
                echo "<li class='li'><span class=\"btn btn-0\" style=\" background-color:" . $color[4] . " ;  \"><span style=\"color:#FFF; text-align: center; font-size: 30px; \">" . $row2["picked"] . "</span></span></li>";
            } else {
                echo "<li class='li'><span class=\"btn btn-0\" style=\" background-color:" . $color[4] . " ;  \"><span style=\"color:#FFF; text-align: center; font-size: 30px; \">x</span></span></li>";
            }
        }
        echo "</ul>";
//        $resutl = $main->adminDB[$_SESSION["db_1"]]->query($main->select("wheelwiner", $_SESSION["db_1"]) . $main->whereSingle(array("cdate" => date("Y-m-d"))) . $main->orderBy("DESC", "gameid") . $main->limitWithOutOffset(9));
//        $resutl2 = $main->adminDB[$_SESSION["db_1"]]->query($main->select("wheelwiner", $_SESSION["db_1"]) . $main->whereSingle(array("cdate" => date("Y-m-d"))) . $main->orderBy("DESC", "gameid") . $main->limitWithOutOffset(1));
//        if ($row = $resutl2->fetch_assoc()) {
//            $number = $row["gameid"] + 1;
//            if ($number % 2 == 0) {
//                $even.="<div class=\"col-lg-6\" style=\"padding: 0px; margin-bottom: 5px;\">";
//                $even.="<span class=\"btn btn-default\"><strong><b>" . $_SESSION["etimespin"] . "</b></strong></span><strong>=></strong>";
//                $even.="<span class=\"btn btn-0\" style=\" background-color:" . $color[9] . " ;  border-radius: 30%;\"><span style=\"color:#FFF; text-align: center; font-size: 30px; padding: 0px; margin: 0px;\">&nbsp;</span></span><br>";
//                $even.="</div>";
//                array_push($evenarray, $even);
//                //echo "Even Push <br>";
//                $fl = true;
//            } else {
//                $odd.="<div class=\"col-lg-6\" style=\"padding: 0px; margin-bottom: 5px;\">";
//                $odd.="<span class=\"btn btn-default\"><strong><b>" . $_SESSION["etimespin"] . "</b></strong></span><strong>=></strong>";
//                $odd.="<span class=\"btn btn-0\" style=\" background-color: " . $color[9] . ";  border-radius: 30%;\"><span style=\"color:#FFF; text-align: center; font-size: 30px; padding: 0px; margin: 0px;\">&nbsp;</span></span><br>";
//                $odd.="</div>";
//
//                array_push($oddarray, $odd);
//                //echo "Odd Push <br>";
//            }
//        }
//        $even1 = "";
//        $odd1 = "";
//        while ($row = $resutl->fetch_assoc()) {
//            $number = $row["gameid"] + 1;
//            if ($number % 2 != 0) {
//                $even1.="<div class=\"col-lg-6\" style=\"padding: 0px; margin-bottom: 5px;\">";
//                $even1.="<span class=\"btn btn-default\"><strong><b>" . $row["etime"] . "</b></strong></span><strong>=></strong>";
//                $even1.="<span class=\"btn btn-0\" style=\" background-color:" . $color[$row["picked"]] . " ;  border-radius: 30%;\"><span style=\"color:#FFF; text-align: center; font-size: 30px; padding: 0px; margin: 0px;\">" . $row["picked"] . "</span></span><br>";
//                $even1.="</div>";
//                array_push($evenarray, $even1);
//                $even1 = "";
//                //echo "Even Push <br>";
//            } else {
//                $odd1.="<div class=\"col-lg-6\" style=\"padding: 0px; margin-bottom: 5px;\">";
//                $odd1.="<span class=\"btn btn-default\"><strong><b>" . $row["etime"] . "</b></strong></span><strong>=></strong>";
//                $odd1.="<span class=\"btn btn-0\" style=\" background-color: " . $color[$row["picked"]] . ";  border-radius: 30%;\"><span style=\"color:#FFF; text-align: center; font-size: 30px; padding: 0px; margin: 0px;\">" . $row["picked"] . "</span></span><br>";
//                $odd1.="</div>";
//                array_push($oddarray, $odd1);
//                $odd1 = "";
//                //echo "Odd Push <br>";
//            }
//        }
//
//        for ($i = 0; $i < 10; $i++) {
//
//            if (isset($oddarray[$i])) {
//
//                echo $oddarray[$i];
//            }
//            if (isset($evenarray[$i])) {
//
//                echo $evenarray[$i];
//            }
//        }
    }
    ?>

</div>

