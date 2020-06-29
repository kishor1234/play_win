<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Message</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php
    $result = $main->adminDB[$_SESSION["db_1"]]->query($main->select("message", $_SESSION["db_1"]));
    while ($row = $result->fetch_assoc()) {
        $status = "<span id='require'>Deleted</span>";
        if ($row["is_active"] == 0) {
            $status = "<span style='color:green'>Active</span>";
        }
        echo "<tr>"
        . "<td>" . $row["id"] . "</td>"
        . "<td>" . $row["msg"] . "</td>"
        . "<td>" . $row["on_date"] . "</td>"
        . "<td>" . $status . "</td>";
        ?>
        <td><a href="#" onclick="ajaxLinkCall('<?php echo $obj->encdata("C_DeleteMessage");?>&mid=<?php echo $row["id"];?>','#displayMessage');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
    </tr>
    <?php
}
?>
</table>