<?php
$stime = strtotime(date("11:00:00"));
$endtime = strtotime(date("21:30:00"));
while ($stime <= $endtime) {
    $te = date("H:i:s", strtotime('+15 minutes', $stime));
    echo "INSERT INTO `gametime`( `stime`, `etime`,`status`) VALUES ('" . date("H:i:s", $stime) . "','" . $te . "','0');<br>";
    $stime = strtotime($te);
}
//date("Y-m-d H:i:s", strtotime('+5 minutes', $currenttime))
die;
for ($i = 300; $i > 0; $i--) {
    // echo "INSERT INTO `lottoweight`(`number`) VALUES ('".$i."');";
    echo "ALTER TABLE `wheelw` ADD `" . $i . "` INT NOT NULL DEFAULT '0' AFTER `weight`;<br>";
}
die;
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Test</title>
        <style type="text/css">
            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group }
            tfoot { display:table-footer-group }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr><th>heading</th></tr>
            </thead>
            <tfoot>
                <tr><td>notes</td></tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>x</td>
                </tr>
                <tr>
                    <td>x</td>
                </tr>
                <?php
                for ($i = 1; $i <= 500; $i++) {
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td>x</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
<?php
die;
for ($j = 1; $j <= 200; $j++) {
    echo "UPDATE `lottoweight` SET `" . $j . "` = '0';<br>";
}

for ($i = 1000; $i < 2000; $i = $i + 100) {
    for ($j = 1; $j <= 200; $j++) {
        echo "UPDATE `" . $i . "` SET `" . $j . "` = '0';<br>";
    }
}
die;
for ($i = 300; $i > 200; $i--) {
    // echo "INSERT INTO `lottoweight`(`number`) VALUES ('".$i."');";

    echo "ALTER TABLE `wheelw` ADD `" . $i . "` INT NOT NULL DEFAULT '0' AFTER `weight`;<br>";
}
die;

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$a = UniqueRandomNumbersWithinRange(0, 9, 10);
print_r($a);
die;
$a = array("0" => "0", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");


for ($i = 0; $i < 10; $i++) {
    echo $a[$i] . "<br>";
}
die;
for ($i = 1000; $i < 2000; $i = $i + 100) {
    echo $i . "<br>";
}
die;
$a1 = array("red", "green");
$a2 = array("blue", "yellow");
$t = array_merge($a1, $a2);

//echo rand(0,9);
//die();
//UPDATE `lottoweight` SET `2` = '10' WHERE `lottoweight`.`number` = '01';//
for ($i = 200; $i > 0; $i--) {
    // echo "INSERT INTO `lottoweight`(`number`) VALUES ('".$i."');";

    echo "ALTER TABLE `lottoweight` ADD `" . $i . "` INT NOT NULL DEFAULT '0' AFTER `weight`;<br>";
}
die;
$stime = strtotime(date("10:03:00"));
$endtime = strtotime(date("22:00:00"));
while ($stime <= $endtime) {
    $te = date("H:i:s", strtotime('+3 minutes', $stime));
    echo "INSERT INTO `wheelgtime`( `stime`, `etime`) VALUES ('" . date("H:i:s", $stime) . "','" . $te . "');<br>";
    $stime = strtotime($te);
}
//date("Y-m-d H:i:s", strtotime('+5 minutes', $currenttime))
die;
?>
<?php
for ($j = 00; $j < 100; $j++) {
    echo $j . "<br>";
}
$num = 10;
$num_padded = sprintf("%02d", $num);
echo $num_padded; // returns 04
die;
?>
<?php
/* $a1=array("red","green");
  $a2=array("blue","yellow");
  $a3=array_merge($a1,$a2);
  print_r($a3);
  for($i=0;$i<100;$i++)
  {
  echo "INSERT INTO `lottoweight`(`number`) VALUES ('".$i."');<br>";
  }

  /*function lottery649($maxn = "100",$maxb="10") {
  srand((double) microtime() * 1000000);
  while (1>0) {
  $lottery[] = rand(1,$maxn);
  $lottery = array_unique($lottery);
  if (sizeof($lottery) == $maxb) break;
  }
  sort($lottery);
  print_r($lottery);
  return implode(", ",$lottery);
  }
  $lottery649 = lottery649();
  //echo $lottery649;
 * ?\
 */
for ($i = 10; $i < 23; $i++)
    echo $i . "=>" . strtotime(date($i . ":00:00")) . "<br>";
die;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Wheel of Fortune Bingo</title>

        <!--
            
        MIT License
        
        Copyright (c) 2017 Jeremy Rue
        
        Permission is hereby granted, free of charge, to any person obtaining a copy
        of this software and associated documentation files (the "Software"), to deal
        in the Software without restriction, including without limitation the rights
        to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
        copies of the Software, and to permit persons to whom the Software is
        furnished to do so, subject to the following conditions:
        
        The above copyright notice and this permission notice shall be included in all
        copies or substantial portions of the Software.
        
        THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
        IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
        FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
        AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
        LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
        OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
        SOFTWARE.
        -->

        <style type="text/css">
            text{
                font-family:Helvetica, Arial, sans-serif;
                font-size:20px;


                //pointer-events:none;

            }
            #chart{
                position:absolute;
                width:100px;
                height:100px;
                top:0;
                left:0;
            }
            #question{
                position: absolute;
                width:400px;
                height:500px;
                top:-140px;
                left:220px;
            }
            #question h1{
                font-size: 50px;
                font-weight: bold;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                position: absolute;
                padding: 0;
                margin: 0;
                top:50%;
                -webkit-transform:translate(0,-50%);
                transform:translate(0,-50%);
            }

        </style>

    </head>
    <body>
        <div id="chart"></div>
        <div id="question"><h1>Test</h1></div>
        <script src="j.js" type="text/javascript"></script>
       <!-- <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>-->
        <script type="text/javascript" charset="utf-8">
            var padding = {top: 20, right: 40, bottom: 0, left: 0},
            w = 200 - padding.left - padding.right,
                    h = 200 - padding.top - padding.bottom,
                    r = Math.min(w, h) / 2,
                    rotation = 0,
                    oldrotation = 0,
                    picked = 100000,
                    oldpick = [],
                    color = d3.scale.category20();//category20c()
            //randomNumbers = getRandomNumbers();

            //http://osric.com/bingo-card-generator/?title=HTML+and+CSS+BINGO!&words=padding%2Cfont-family%2Ccolor%2Cfont-weight%2Cfont-size%2Cbackground-color%2Cnesting%2Cbottom%2Csans-serif%2Cperiod%2Cpound+sign%2C%EF%B9%A4body%EF%B9%A5%2C%EF%B9%A4ul%EF%B9%A5%2C%EF%B9%A4h1%EF%B9%A5%2Cmargin%2C%3C++%3E%2C{+}%2C%EF%B9%A4p%EF%B9%A5%2C%EF%B9%A4!DOCTYPE+html%EF%B9%A5%2C%EF%B9%A4head%EF%B9%A5%2Ccolon%2C%EF%B9%A4style%EF%B9%A5%2C.html%2CHTML%2CCSS%2CJavaScript%2Cborder&freespace=true&freespaceValue=Web+Design+Master&freespaceRandom=false&width=5&height=5&number=35#results

            var data = [
                {"label": "0", "value": 0, "question": "0"},
                {"label": "1", "value": 1, "question": "1"}, // padding
                {"label": "2", "value": 2, "question": "2"},
                {"label": "3", "value": 3, "question": "3"},
                {"label": "4", "value": 4, "question": "4"},
                {"label": "5", "value": 5, "question": "5"},
                {"label": "6", "value": 6, "question": "6"},
                {"label": "7", "value": 7, "question": "7"},
                {"label": "8", "value": 8, "question": "8"},
                {"label": "9", "value": 9, "question": "9"}
            ];


            var svg = d3.select('#chart')
                    .append("svg")
                    .data([data])
                    .attr("width", w + padding.left + padding.right)
                    .attr("height", h + padding.top + padding.bottom);

            var container = svg.append("g")
                    .attr("class", "chartholder")
                    .attr("transform", "translate(" + (w / 2 + padding.left) + "," + (h / 2 + padding.top) + ")");

            var vis = container
                    .append("g");

            var pie = d3.layout.pie().sort(null).value(function (d) {
                return 1;
            });

            // declare an arc generator function
            var arc = d3.svg.arc().outerRadius(r);

            // select paths, use arc generator to draw
            var arcs = vis.selectAll("g.slice")
                    .data(pie)
                    .enter()
                    .append("g")
                    .attr("class", "slice");


            arcs.append("path")
                    .attr("fill", function (d, i) {
                        return color(i);
                    })
                    .attr("d", function (d) {
                        return arc(d);
                    });

            // add the text
            arcs.append("text").attr("transform", function (d) {
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle) / 2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius - 10) + ")";
            })
                    .attr("text-anchor", "end")
                    .text(function (d, i) {
                        return data[i].label;
                    });

            container.on("click", spin);


            function spin(d) {

                container.on("click", null);

                //all slices have been seen, all done
                console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
                if (oldpick.length == data.length) {
                    console.log("done");
                    container.on("click", null);
                    return;
                }

                var ps = 360 / data.length,
                        pieslice = Math.round(1440 / data.length),
                        rng = Math.floor((Math.random() * 1440) + 360);


                rotation = (Math.round(rng / ps) * pieslice);

                picked = Math.round(data.length - (rotation % 360) / ps);
                picked = picked >= data.length ? (picked % data.length) : picked;


                if (oldpick.indexOf(picked) !== -1) {
                    d3.select(this).call(spin);
                    return;
                } else {
                    // oldpick.push(picked);
                }

                rotation += 90 - Math.round(ps / 2);

                vis.transition()
                        .duration(3000)
                        .attrTween("transform", rotTween)
                        .each("end", function () {

                            //mark question as seen
                            d3.select(".slice:nth-child(" + (picked + 1) + ") path");

                            //populate question
                            d3.select("#question h1")
                                    .text(data[picked].question);

                            oldrotation = rotation;

                            container.on("click", spin);
                        });
            }

            //make arrow
            svg.append("g")
                    .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h / 2) + padding.top) + ")")
                    .append("path")
                    .attr("d", "M-" + (r * .60) + ",0L0," + (r * .08) + "L0,-" + (r * .08) + "Z")
                    .style({"fill": "black"});

            //draw spin circle
            container.append("circle")
                    .attr("cx", 0)
                    .attr("cy", 0)
                    .attr("r", 30)
                    .style({"fill": "white", "cursor": "pointer"});

            //spin text
            container.append("text")
                    .attr("x", 0)
                    .attr("y", 15)
                    .attr("text-anchor", "middle")
                    .text("")
                    .style({"font-weight": "bold", "font-size": "30px"});


            function rotTween(to) {
                var i = d3.interpolate(oldrotation % 360, rotation);
                return function (t) {
                    return "rotate(" + i(t) + ")";
                };
            }


            function getRandomNumbers() {
                var array = new Uint16Array(1000);
                var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);

                if (window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function") {
                    window.crypto.getRandomValues(array);
                    console.log("works");
                } else {
                    //no support for crypto, get crappy random numbers
                    for (var i = 0; i < 1000; i++) {
                        array[i] = Math.floor(Math.random() * 100000) + 1;
                    }
                }
                console.log(array);
                return array;
            }

        </script>
    </body>
</html>