<legend>Lucky Wheel Advance Draw</legend>
<button class="btn btn-default" id="adloto" onclick="lotoadselect('#adloto','false')">Select All</button>
<input type="number" placeholder="Enter Number to Select Draw " id="num" onkeyup="selectDraw()" >
<table  class="table table-bordered table-responsive table-striped">


    <?php
    $i = 1;
    $t = 0;
    $sql = $main->select("wheelgtime", $_SESSION["db_1"]) . $main->whereSinglegreaterthanequal(array("etime" => date("H:i:s")));

    $result = $main->adminDB[$_SESSION["db_1"]]->query($sql);
    while ($row = $result->fetch_assoc()) {
        if ($t == 5) {
            echo "<tr>";
            $t = 0;
        }
        ?>

        <th><input type="checkbox" onclick="addrdaw('#ch<?php echo $i; ?>')"  id="ch<?php echo $i; ?>" value="<?php echo $row["id"]; ?>"> <?php echo sprintf("%02d", $row["id"]) . " [" . $row["etime"] . "]"; ?></th>

        <?php
        $i++;
        $t++;
        if ($t == 5) {
            echo "<tr>";
        }
    }
    ?>
    <input type="hidden" id="tdraw" value="<?php echo $i; ?>">
</table>