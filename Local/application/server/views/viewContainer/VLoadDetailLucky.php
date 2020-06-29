<?php
//print_r($row);
$loadarray=  json_decode($row["loadarray"]);

echo "<Strong>Draw ID:= ".$row["gameid"]."</Strong>";

    //echo "<br><label><strong>".[gameid] ."</strong></label><br>";
    echo"<table class='table table-bordered'>";
    for($i=0;$i<count($loadarray)-1;$i++)
    {
        echo "<tr>";
        for($j=0;$j<10;$j++)
        {
           echo "<td><center><span><strong>".$i."</strong></span><br><p style='color:red;'>".$loadarray[$i]."</p></td>"; 
           $i++;
        }
        echo "</tr>";
    }
    echo "</table>";
   

?>