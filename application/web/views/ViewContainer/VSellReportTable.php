<?PHP
$data = "";
$ntotal = 0;
$ftotal = 0;
$sl = $main->select("usertranscation", $_SESSION["db_1"]) . $main->whereBetweenDatesID('on_create', $main->filterPost("cdate"), $main->filterPost("tdate"), "userid", $_SESSION["userid"]);
$result = $main->adminDB[$_SESSION["db_1"]]->query($sl);
$fnpay = 0;
$i=1;
$wamt=0;
while ($row = $result->fetch_assoc()) {
    //echo $main->select("entry",$_SESSION["db_1"]).$main->where(array("entetydate"=>$main->filterPost("cdate"),"id"=>$row["invoiceno"]),"AND");
    $tc = $main->getData($main->select("entry", $_SESSION["db_1"]) . $main->whereSingle(array("id" => $row["invoiceno"]), "AND"), "winamt");
    $nc = $row["netamt"] - $row["discountamt"] - $tc;
    $data.= "<tr>";
    $data.= "<td>" . $i . "</td>";
    $data.= "<td>" . $row["userid"] . "</td>";
    $t="";
    $s=0;
    if($row["gid"]==1)
    {
        $t="<td>LOTO</td>";$so=0;
    }else{
        $t="<td>LUCKY WHEEL</td>";$s=1;
    }
    $data.=$t;
    $data.= "<td><a href='#' data-toggle=\"modal\" data-target=\"#reprint\" onclick=\"ReprintPostFromReport('#Test','".$obj->encdata("C_ReprintTicket")."','#reprintdisply','".$s."-".$row["invoiceno"]."')\" class='btn btn-primary btn-sm'>" . $row["invoiceno"] . "</a></td>";
    $data.= "<td>" . $row["drawid"] . "</td>";
    $data.= "<td>" . $row["netamt"] . "</td>";
    $data.= "<td>" . $row["discount"] . " %</td>";
    $data.= "<td>" . $row["discountamt"] . "</td>";
    $data.= "<td>" . $row["total"] . "</td>";
    $data.= "<td>" . $tc . "</td>";
    $data.= "<td>" . $nc . "</td>";
    $data.= "<td>" . $row["on_create"] . "</td>";
    $data.= "</tr>";
    $ntotal = $ntotal + (float) $row["netamt"];
    $ftotal = $ftotal + (float) $row["total"];
    $fnpay = $fnpay + (float) $nc;
    $wamt=$wamt+(float)$tc;
    $i++;
}
?>
<br>
<table class="table table-striped">
    <tr><th>TOTAL NET POINT</th><th>:</th><td><?php echo "₹" . $ntotal; ?></td><td>&nbsp;</td>
        <th>TOTAL  POINT</th><th>:</th><td><?php echo "₹" . $ftotal; ?></td>
        <th>WIN  POINT</th><th>:</th><td><?php echo "₹" . $wamt; ?></td>
        <th>NET PAYABLE</th><th>:</th><td><?php echo "₹" . $fnpay; ?></td>
    </tr>
</table>
<div style="display:none">
    <div id="rpt">
        <strong><h1>Sell Report</h1>
            <p>Date on </p>
            <p><?php echo $main->filterPost("cdate"); ?></p>
            <p>To</p>
            <p><?php echo $main->filterPost("tdate"); ?></p>
            <table>
                <tr>
                <tr><th>TOTAL NET POINT</th><th>:</th><td><?php echo "" . $ntotal; ?></td>
                </tr>
                <tr>
                <tr><th>TOTAL POINT</th><th>:</th><td><?php echo "" . $ftotal; ?></td>
                </tr>
                <tr><th>WIN POINT</th><th>:</th><td><?php echo "" . $wamt; ?></td>
                </tr>
                <tr>
                <tr><th>NET PAYABLE</th><th>:</th><td><?php echo "" . $fnpay; ?></td>
                </tr>
            </table>
        </strong>
    </div>
    </div>
<button class="btn btn-success btn-sm" onclick="Popup($('#rpt').html())"><i class="fa fa-print"></i> Print Report</button>

<br><br>
<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>USER ID</th>
        <th>GAME</th>
        <th>TICKET NO</th>
        <th>DRAW ID</th>
        <th>NET POINT</th>
        <th>DISCOUNT IN %</th>
        <th>DISCOUNT POINT</th>
        <th>FINAL POINT</th>
        <th>WIN POINT</th>
        <th>NET PAYABLE</th>
        <th>DATE</th>
    </tr>
    <?php echo $data; ?>
</table>
<br><br><br>