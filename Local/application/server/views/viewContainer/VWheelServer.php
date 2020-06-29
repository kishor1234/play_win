<style type="text/css">
    text{
        font-family:Helvetica, Arial, sans-serif;
        font-size:20px;
    }
    #chart{
        position:absolute;
        width:100px;
        height:100px;
        top:50px;
        left:10px;
    }
    #question{
        position: absolute;
       
        top:-115px;
        left:230px;
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


<script src="j.js" type="text/javascript"></script>

<!-- <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>-->
<script type="text/javascript" charset="utf-8">
    var padding = {top: 20, right: 40, bottom: 0, left: 0},
    w = 200 - padding.left - padding.right,
            h = 150 - padding.top - padding.bottom,
            r = Math.min(w, h) / 2,
            rotation = 0,
            oldrotation = 0,
            picked = 10,
            oldpick = [],
            color = d3.scale.category20();
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
        return "rotate(" + (d.angle * 180 / Math.PI - 85) + ")translate(" + (d.outerRadius - 20) + ")";
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

        rotation = (Math.round(rng / ps) * ps);

        picked = Math.round(data.length - (rotation % 360) / ps);
        picked = picked >= data.length ? (picked % data.length) : picked;
        $.post("/?r=<?php echo $obj->encdata("C_LuckyWheelServerResult");?>",{
                        rotation:rotation,
                        oldrotation:rotation,
                        picked:picked,
                        ps:ps,
                        rng:rng
                    },function(data){
                        //alert(data);
                    });

        if (oldpick.indexOf(picked) !== -1) {
            d3.select(this).call(spin);
            return;
        } else {
            //alert(picked);
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
            .attr("d", "M-" + (r * 1.00) + ",0L0," + (r * .08) + "L0,-" + (r * .08) + "Z")
            .style({"fill": "black"});

    //draw spin circle
    container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 25)
            .style({"fill": "white", "cursor": "pointer"});

    //spin text
    container.append("text")
            .attr("x", 0)
            .attr("y", 10)
            .attr("text-anchor", "middle")
            .text("SPIN")
            .style({"font-weight": "bold", "font-size": "20px"});


    function rotTween(to) {
        var i = d3.interpolate(oldrotation % 360, rotation);
        return function (t) {

            return "rotate(" + i(t) + ")";
        };
    }



</script>