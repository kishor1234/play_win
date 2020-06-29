<div id="loading" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <center> 
            <div id="dips">
                <img src="/assets/img/loadin.gif" alt="" style="height: 100px;"/>
            </div>
        </center>

    </div>
</div>

<script>
    var loadingimg = '<center><img src="https://d15omoko64skxi.cloudfront.net/wp-content/uploads/2017/07/avatar-black.gif" alt="Loading...."></center>';
    loadbal();
    setInterval(loadbal, 10000);
    function loadbal()
    {
        $.post("/?r=<?php echo $obj->encdata("C_UserBalance"); ?>", {}, function (d) {
            $("#bal").html(d);

        });
    }
    function addrdaw(id)
    {
        var l = parseInt($("#tdraw").val());
        var data = "";
        for (var i = 1; i <= l; i++)
        {
            if ($("#ch" + i).prop("checked") === true)
            {
                data = data + $("#ch" + i).val() + ",";
            }
        }
        $("#adarr").val(data);
    }

    function loadingImage()
    {
        return '<img src="/assets/img/loadin.gif" alt="" style="height: 100px;"/>';
    }

    function onLoading()
    {
        $("#loading").modal('toggle');
    }

    function offLoading()
    {
        $("#loading").modal('hide');
    }

    function printMsg(msg)
    {
        $.post("/?r=<?php echo $obj->encdata("C_PrintMsg"); ?>", {}, function (data) {
            $(msg).html(data);
        });
    }
    function clearcart()
    {
        $.post("/?r=<?php echo $obj->encdata("C_EmptyCart"); ?>", {}, function (data) {
            $("#cart").html(data);
        });
    }
    function formPost(id, file, display)
    {

        var formData = new FormData($(id)[0]);
        onLoading();
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                offLoading();
                $(display).html(data);
                printMsg("#msg");
                //alert(data); // show response from the php script.
            }

        });

        $(id)[0].reset();
        return false;
    }
    function formPostuser(id, file, display)
    {

        var formData = new FormData($(id)[0]);
        //onLoading();
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                // offLoading();
                //$(display).html(data);
                Popup(data);
                $(id)[0].reset();

                //printMsg("#msg");
                //alert(data); // show response from the php script.
            }

        });


        return false;
    }
    function formPostCart(id, file, display)
    {

        var formData = new FormData($(id)[0]);
        // onLoading();
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                //offLoading();
                $(display).html(data);
                $.post("/?r=<?php echo $obj->encdata("C_GETTotal"); ?>", {}, function (dat) {

                    var d = dat.split("|");
                    $("#ntotal").val(d[0]);
                    $("#gtotal").val(d[1]);
                    $("#total").val(d[2]);//Math.round(d[2])
                    $("#netamount").val(d[2]);
                    $("#gtot").val(d[1]);
                    $("#ntot").val(d[0]);
                });
                printMsg("#msg");
                //alert(data); // show response from the php script.
            }

        });

        $(id)[0].reset();
        $("#product").focus();
        return false;
    }
    function formPostCartBarcode(id, file, display)
    {

        var formData = new FormData($(id)[0]);
        //onLoading();
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                //offLoading();
                $(display).html(data);
                $.post("/?r=<?php echo $obj->encdata("C_GETTotal"); ?>", {}, function (dat) {

                    var d = dat.split("|");
                    $("#ntotal").val(d[0]);
                    $("#gtotal").val(d[1]);
                    $("#total").val(d[2]);//Math.round(d[2])
                    $("#netamount").val(d[2]);
                    $("#gtot").val(d[1]);
                    $("#ntot").val(d[0]);
                });
                printMsg("#msg");
                //alert(data); // show response from the php script.
            }

        });

        $(id)[0].reset();
        return false;
    }
    function calamount(i)
    {
        //alert($("#point"+i).val());
        var point = parseInt($("#points" + i).val());
        var finalamount = point * 2;
        $("#amount" + i).val(finalamount);
        return false;
    }

    function cal1()
    {
        var netamount = replaceZero(parseFloat($("#netamount").val()));
        var pay = replaceZero(parseFloat($("#payed").val()));
        var remain = netamount - pay;
        if (remain < 0) {
            alert("Enter amount is greater than Total Amount..!");
            $("#remain").val("");
            $("#payed").val(0);

        } else if (remain == 0) {
            //$("#paytype").val("Cash");
            $("#remain").val(remain);
        } else {
            $("#remain").val(remain);
        }
    }

    function checkvalidfornumber()
    {
        $("#chaqueno").keypress(function (e) {
            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#emsg").css("color", "red");
                $("#emsg").html("Digits Only").show().fadeOut("slow");
                return false;
            }
        });
    }
    function formPostuni(id, file, display)
    {
        var formData = new FormData($(id)[0]);
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                $(display).html(data);
                $(id)[0].reset();
            }

        });
        //
        return false;
    }

    function formPostuni2(id, file, display)
    {
        var formData = new FormData($(id)[0]);
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                $(display).html(data);
                $(id)[0].reset();
                $.post("/?r=<?php echo $obj->encdata("C_OpenLink") . "&v=" . $obj->encdata("Vngttotal"); ?>", {}, function (dat) {
                    $("#table_display").html(dat);
                    $.post("/?r=<?php echo $obj->encdata("C_OpenLink") . "&v=" . $obj->encdata("printTotal"); ?>", {}, function (d) {
                        $("#totalamount").html(d);
                        $("#amountf").val(d);
                    });
                });
            }

        });
        //
        return false;
    }

    function reset(id)
    {
        $(id)[0].reset();
    }

    function formPost2(id, file, display, num)
    {

        var formData = new FormData($(id)[0]);
        formData.append("key", num);
        //alert(num);
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //alert(data);
                $(display).html(data);
                printMsg(display);
                //alert(data); // show response from the php script.
            }

        });

        //$(id)[0].reset();
        return false;
    }
    function formPost4(id, file, display)
    {
        $(display).html("");
        $('#claimTicketmodal').modal({
            show: 'true'
        });
        var formData = new FormData($(id)[0]);
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //$('#myWin').modal('show');
                $(display).html(data);

            }

        });

        $(id)[0].reset();
        return false;
    }
    function ReprintPost(fid, file, dispaly, i)
    {

        $.post("/?r=" + file, {id: i}, function (data) {

            $(dispaly).html(data);
        });
        return false;
    }
    function ReprintPostFromReport(fid, file, display, i)
    {
        $(display).html(loadingimg);
        $.post("/?r=" + file, {id: i}, function (data) {

            $(display).html(data);
        });
        return false;
    }
    function formPost3(id, file, display)
    {
        $(display).html(loadingimg);
        var formData = new FormData($(id)[0]);
        $.ajax({
            type: "POST",
            url: '/?r=' + file,
            data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
            contentType: false,
            processData: false,
            success: function (data)
            {
                //$('#myWin').modal('show');
                $(display).html(data);

            }

        });

        $(id)[0].reset();
        return false;
    }


    function replaceZero(number)
    {
        if (number >= 0) {
            return number;
        } else {
            return 0;
        }

    }

    function postClaim(file, id)
    {
        $.post("/?r=" + file, {id: id}, function (data) {
            Popup(data);
        });
    }

    function reprint(div, btn)
    {
        $(btn).hide();

        Popup($(div).html());
        //document.location.reload();
        return false;
    }
    function printloto(div, btn)
    {
        $(btn).hide();

        Popup($(div).html());
        draw();
        document.location.reload();
        return false;
    }
    function printspin(div, btn)
    {
        $(btn).hide();

        Popup($(div).html());
        drawSpin();
        document.location.reload();
        return false;
    }
    function print(print, form)
    {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        $(form).show();

    }
    function wait(ms) {
        var start = new Date().getTime();
        var end = start;
        while (end < start + ms) {
            end = new Date().getTime();
        }
    }
    function Popup(data) {
        var mywindow = window.open();
        mywindow.document.write(data);
        setTimeout(function () {
            console.log("Set");
            mywindow.print();
            mywindow.close();
            
        }, 100);


        return true;
    }

</script>
<script type="text/javascript">
    function clocks(clock, t)
    {
        /*if (t < 0) {
         t = 0;
         setTimeout(draw, 1000);
         }*/
        clock = $('.clock').FlipClock(t, {
            clockFace: 'MinuteCounter',
            countdown: true,
            callbacks: {
                stop: function () {
                    $("#result").html(loadingImage);
                    //setTimeout(spin(), 100000);
                    draw();

                }
            }
        });


    }
    var flag = false;

    function resetAllloto(id)
    {
        $(id)[0].reset();
        clearBtnloto();
        clearpadloto();
        for (var i = 0; i < 100; i++)
        {
            $("#e_0_" + pn(i)).attr("class", "form-control bgw");
        }
        $("#gtotal").val("");
        $("#adarr").val("");
        $("#totalpoint").val("");
        $("#totalamount").val("");
        $("#totalqty_0").val("");
        $("#totalamt_0").val("");
        $("#fp").prop("checked", false);
        for (var j = 10; j < 20; j++)
        {
            $("#selectDraw_" + j).attr("checked", false);
        }
        return false;
    }
    function clearBtnloto()
    {
        for (var i = 10; i < 20; i++)
        {
            $("#btn_" + i).val("");
        }
    }
    ;
    function clearpadloto() {
        for (var i = 0; i < 100; i++)
        {
            $("#e_0_" + pn(i)).val("");
        }
        for (var i = 0; i < 100; i = i + 10)
        {
            $("#row_0_" + i).val("");

        }
        for (var i = 0; i < 10; i++)
        {
            $("#col_0_" + i).val("");

        }
    }
    function draw()
    {
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRound"); ?>", {}, function (data) {

            var obj = jQuery.parseJSON(data);

            $("#gid").html(obj.id);
            $("#stime").html(obj.etime);
            $("#etime").html(obj.etime);
            clocks(clock, obj.time);
            setTimeout(result, 1000);

        });

    }

    function resetLotoClock() {
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRound"); ?>", {}, function (data) {
            var obj = jQuery.parseJSON(data);
            $("#gid").html(obj.id);
            $("#stime").html(obj.etime);
            $("#etime").html(obj.etime);
            clocks(clock, obj.time);
            //setTimeout(result, 1000);

        });

    }

    function result()
    {
        $.post("/?r=<?php echo $obj->encdata("C_Vresult"); ?>", {}, function (dat) {
            $("#display").html(dat);
            $.post("/?r=<?php echo $obj->encdata("C_VLastResult"); ?>", {}, function (dat2) {
                $("#hrpoint").html(dat2);
                //$("#result").html("");
                $.post("/?r=<?php echo $obj->encdata("C_LottoAdvanceDrawChart"); ?>", {}, function (d) {
                    $("#lotoad").html(d);
                    $.post("/?r=<?php echo $obj->encdata("C_LastLotoLResult"); ?>", {}, function (d1) {
                        $("#result").html(d1);
                    });
                });
            });
        });


    }
    var clock;



    function callCanvas()
    {
        var canvasC = document.getElementById('canvasbg');
        var cC = canvasC.getContext('2d');
        canvasC.height = window.innerHeight;
        canvasC.width = window.innerWidth;

        var mouse = {
            x: undefined,
            y: undefined

        };
        var maxRadius = 40;
        var minRadius = 2;
        var colorArray = [
            '#BE6C84',
            '#665F79',
            '#355E7C',
            '#F0747F',
            '#F6B192'
        ];
        window.addEventListener('mousemove', function (event) {
            mouse.x = event.x;
            mouse.y = event.y;
            //console.log(mouse);
        });
        window.addEventListener('resize', function () {
            canvasC.height = window.innerHeight;
            canvasC.width = window.innerWidth;
            init();
        });
        function cricle(x, y, radius, dx, dy)
        {
            this.x = x;
            this.y = y;
            this.radius = radius;
            this.minRadius = radius;
            this.dx = dx;
            this.dy = dy;
            this.color = colorArray[Math.floor(Math.random() * colorArray.length)];
            this.drawC = function () {
                cC.beginPath();
                cC.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
                cC.fillStyle = this.color;
                cC.fill();
            };
            this.updateC = function () {
                if (this.x + this.radius > innerWidth || this.x - this.radius < 0)
                {
                    this.dx = -this.dx;
                }
                if (this.y + this.radius > innerHeight || this.y - this.radius < 0)
                {
                    this.dy = -this.dy;
                }
                this.x += this.dx;
                this.y += this.dy;

                if (mouse.x - this.x < 50 && mouse.x - this.x > -50
                        && mouse.y - this.y < 50 && mouse.y - this.y > -50)
                {
                    if (this.radius < maxRadius)
                    {
                        this.radius += 1;
                    }
                }
                else if (this.radius > this.minRadius) {
                    this.radius -= 1;
                }

                this.drawC();
            };
        }
        var cArray = [];
        function initC()
        {
            cArray = []
            for (var i = 0; i < 500; i++)
            {
                var radius = Math.random() * 3 + 1;
                var x = Math.random() * (innerWidth - radius * 2);
                var y = Math.random() * (innerHeight - radius * 2);
                var dx = (Math.random() - 0.5);
                var dy = (Math.random() - 0.5);
                cArray.push(new cricle(x, y, radius, dx, dy));
            }
            animates();
        }

        function animates() {
            requestAnimationFrame(animates);

            cC.clearRect(0, 0, innerWidth, innerHeight);
            for (var i = 0; i < cArray.length; i++)
            {
                cArray[i].updateC();
            }

        }
        initC();
    }
</script>
<script>
    var canvas = document.getElementById("canvas");
    var c = canvas.getContext('2d');
    canvas.height = 150;//window.innerHeight;
    canvas.width = 150;//window.innerWidth;

    var mouse = {
        x: undefined,
        y: undefined

    };
    var maxRadius = 40;
    var minRadius = 2;
    var colorArray = [
        '#15959F',
        '#F1E4B3',
        '#F4A090',
        '#F26144',
        '#E069FF',
        '#76B5FF',
        '#9EFFB8',
        '#60E8DE',
        '#CAC5E8'
    ];
    var gravity = 1;
    var friction = 0.99;

    function randomIntFromRange(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    //console.log(randomIntFromRange(0, 20));
    function randomColor(colorArray) {
        return colorArray[Math.floor(Math.random() * colorArray.length)];
    }
    //ball class
    function Ball(x, y, dx, dy, radius, color, number)
    {
        this.x = x;
        this.y = y;
        this.radius = radius;
        this.color = color;
        this.dx = dx;
        this.dy = dy;
        this.draw = function ()
        {
            c.beginPath();
            c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
            c.fillStyle = this.color;
            c.fill();
            c = canvas.getContext("2d");
            c.font = '8pt Arial';
            c.fillStyle = 'black';
            c.textAlign = 'center';
            c.fillText(number, this.x, this.y + 3);
            c.closePath();
        }
        this.update = function () {
            //friction=Math.random()*1;

            if (this.x + this.radius > canvas.width || this.x - this.radius < 0)
            {
                this.dx = -this.dx;
            }
            if (this.y + this.radius > canvas.height || this.y - this.radius < 0)
            {
                this.dy = -this.dy;
            }

            this.x += this.dx;
            this.y += this.dy;
            this.draw();
        };
    }
    var ball;
    var ballArray = [];
    function init()
    {
        ballArray = [];
        for (var i = 1; i < 100; i++)
        {
            var radius = 10;
            var x = randomIntFromRange(radius, canvas.width - radius);
            var y = randomIntFromRange(radius, canvas.height - radius);
            var color = randomColor(colorArray);
            var dx = randomIntFromRange(-2, 2);
            ballArray.push(new Ball(x, y, dx, 2, radius, color, i));
        }

        animate();
    }
    function animate()
    {
        requestAnimationFrame(animate);
        c.clearRect(0, 0, innerWidth, innerHeight);
        //console.log("Kishor");
        for (var i = 1; i < ballArray.length; i++)
        {
            ballArray[i].update();
        }
    }

    init();

</script>
<script>
    function addrow(i, mid)
    {
        var num = parseInt($("#row_" + mid + "_" + i).val());

        if (isNaN(num)) {
            i = pn(i);
            for (var k = 0; k < 10; k++)
            {
                //alert("#e_" + mid + "_" + (i+k));
                $("#e_" + mid + "_" + (k + i)).val("");
            }
        }
        else {
            //i = pn(i);

            for (var k = 0; k < 10; k++)
            {
                var value = $("#col_" + mid + "_" + k).val();
                if (value.localeCompare("") != 0) {
                    $("#e_" + mid + "_" + pn(k + i)).val(num + parseInt(value));
                }
                else {
                    //alert("#e_" + mid + "_" + (k + i));
                    $("#e_" + mid + "_" + pn(k + i)).val(num);
                }
            }
        }
        calNumber(mid);
    }


    function addcol(i, mid)
    {
        var num = parseInt($("#col_" + mid + "_" + i).val());
        if (isNaN(num)) {
            $("#e_" + mid + "_" + (pn(i))).val("");
            var t = i;
            for (var k = 1; k < 10; k++)
            {
                t = t + 10;
                $("#e_" + mid + "_" + pn(t)).val("");
            }
        }
        else {
            var t = i;
            var r = 10;
            for (var k = 0; k < 10; k++)
            {
                var value = $("#row_" + mid + "_" + (pn(k) * 10)).val();
                if (value.localeCompare("") != 0) {
                    $("#e_" + mid + "_" + pn(t)).val(num + parseInt(value));
                }
                else {
                    $("#e_" + mid + "_" + pn(t)).val(num);
                }
                r = r + 10;
                t = t + 10;
            }
        }
        calNumber(mid);
    }
    function calNumber2(event, mid)
    {
        switch (event.keyCode) {
            case 13:
                drawsubmitDTOP(mid);
                break;
        }
        var sumofPoint = 0;
        //alert($("#e_"+mid+"_"+1).val());
        for (var i = 0; i < 100; i++)
        {
            var n = $("#e_" + mid + "_" + pn(i)).val();

            if (n.localeCompare("") != 0)
            {

                sumofPoint = sumofPoint + parseInt(n);
                //console.log(sumofPoint);
            }
            // sumofPoint=sumofPoint;
        }
        var sp = sumofPoint;
        var spp = sumofPoint * 2;

        if (sp === 0) {
            $("#totalqty_" + mid).val("");
        } else {
            $("#totalqty_" + mid).val(sumofPoint);
        }
        ;
        //$("#totalqty_" + mid).val(sumofPoint);
        if (spp === 0) {
            $("#totalamt_" + mid).val("");
        } else {
            $("#totalamt_" + mid).val(sumofPoint * 2);
        }
        // $("#totalamt_" + mid).val(sumofPoint * 2);
        return false;
    }
    function calNumber(mid)
    {
        var sumofPoint = 0;
        //alert($("#e_"+mid+"_"+1).val());
        for (var i = 0; i < 100; i++)
        {
            var n = $("#e_" + mid + "_" + pn(i)).val();

            if (n.localeCompare("") != 0)
            {

                sumofPoint = sumofPoint + parseInt(n);
                //console.log(sumofPoint);
            }
            // sumofPoint=sumofPoint;
        }
        var sp = sumofPoint;
        var spp = sumofPoint * 2;

        if (sp === 0) {
            $("#totalqty_" + mid).val("");
        } else {
            $("#totalqty_" + mid).val(sumofPoint);
        }
        ;
        //$("#totalqty_" + mid).val(sumofPoint);
        if (spp === 0) {
            $("#totalamt_" + mid).val("");
        } else {
            $("#totalamt_" + mid).val(sumofPoint * 2);
        }
        // $("#totalamt_" + mid).val(sumofPoint * 2);
        return false;
    }
    function pn(myNumber)
    {
        return (myNumber.toString().length < 2) ? "0" + myNumber : myNumber;
    }
    function checkfp(mid, n)
    {

        var mega = [['10', '15', '60', '65', '01', '06', '51', '56'],
            ['12', '17', '62', '67', '21', '26', '71', '76'],
            ['13', '18', '63', '68', '31', '36', '81', '86'],
            ['14', '19', '64', '69', '41', '46', '91', '96'],
            ['20', '25', '70', '75', '02', '07', '52', '57'],
            ['23', '28', '73', '78', '32', '37', '82', '87'],
            ['24', '29', '74', '79', '42', '47', '92', '97'],
            ['30', '35', '80', '85', '03', '08', '53', '58'],
            ['34', '39', '84', '89', '43', '48', '93', '98'],
            ['40', '45', '90', '95', '04', '09', '54', '59'],
            ['11', '66', '16', '61'],
            ['22', '27', '72', '77'],
            ['33', '38', '83', '88'],
            ['44', '49', '94', '99'],
            ['55', '50', '00', '05']];
        for (var i = 0; i < 100; i++)
        {
            $("#e_" + mid + "_" + pn(i)).attr("class", "form-control bgw");
        }
        if ($("#fp").prop("checked") === true)
        {
            $("#e_" + mid + "_" + pn(n)).attr("class", "form-control bgy");
            var tv = $("#e_" + mid + "_" + pn(n)).val();

            var sarray;
            for (var i = 0; i < mega.length; i++)
            {
                var temp = mega[i];
                for (var z = 0; z < temp.length; z++)
                {

                    if (parseInt(temp[z]) === parseInt(n)) {
                        sarray = temp;
                        break;
                    }
                }
            }

            for (var z = 0; z < sarray.length; z++)
            {

                if (parseInt(sarray[z]) === parseInt(n)) {
                    // $("#e_" + mid + "_" + pn(n)).attr("class","form-control bgw");
                } else {
                    $("#e_" + mid + "_" + sarray[z]).val(tv);

                    $("#e_" + mid + "_" + sarray[z]).attr("class", "form-control bgy");

                }
            }


        }
        var q = 0;
        for (var i = 0; i < 100; i++)
        {
            var value = parseInt($("#e_" + mid + "_" + pn(i)).val());
            var newValue = (isNaN(value) ? 0 : value);
            q = q + newValue;

        }
        var p = q * 2;
        $("#totalqty_" + mid).val(q);
        $("#totalamt_" + mid).val(p);

    }
    function clearAll(mid)
    {

        for (i = 0; i < 100; i++)
        {
            $("#e_" + mid + "_" + pn(i)).val("");
        }
        calNumber(mid);
        return false;
    }
    function drawsubmit(mid)
    {
        for (j = 10; j < 20; j++)
        {
            if ($("#selectDraw_" + j).prop("checked"))
            {
                var tmid = j * 100;
                for (var i = 0; i < 100; i++) {
                    $("#e_" + tmid + "_" + i).val($("#e_" + mid + "_" + i).val());
                }
                $("#totalqty_" + tmid).val($("#totalqty_" + mid).val());
                $("#totalamt_" + tmid).val($("#totalamt_" + mid).val());
                $("#btn_" + j).val("Selected");
                $("#qty_" + j).val($("#totalqty_" + tmid).val());
                $("#amt_" + j).val($("#totalamt_" + tmid).val());
                $("#sel_" + j).val(tmid);
            }
        }
        $("#myModal").modal("toggle");
        for (j = 10; j < 20; j++)
        {
            $("#selectDraw_" + j).attr("checked", false);
        }
        sumofqtyandamt();
        //sumofqtyandamtDTOP();
        return false;
    }
    function setPoint(i)
    {

        $("#points").val($("#point" + i).val());
        $.post("/?r=C_SetSAMT", {id: $("#point" + i).val()}, function (d) {

        });
    }
    function drawsubmitDTOP(mid)
    {
        var flag = false;
        for (j = 10; j < 20; j++)
        {
            if ($("#selectDraw_" + j).prop("checked"))
            {
                flag = true;
                var tmid = j * 100;
                for (var i = 0; i < 100; i++) {

                    $("#e_" + tmid + "_" + pn(i)).val($("#e_" + mid + "_" + pn(i)).val());
                }
                $("#totalqty_" + tmid).val($("#totalqty_" + mid).val());
                $("#totalamt_" + tmid).val($("#totalamt_" + mid).val());
                $("#btn_" + j).val("Selected");
                $("#qty_" + j).val($("#totalqty_" + tmid).val());
                $("#amt_" + j).val($("#totalamt_" + tmid).val());
                $("#sel_" + j).val(tmid);
            }
        }
        $("#myModal").modal("toggle");
        for (j = 10; j < 20; j++)
        {
            $("#selectDraw_" + j).attr("checked", false);
        }
        sumofqtyandamtDTOP(flag, mid);

        return false;
    }
    function openDraw(i)
    {
        //$("#selectDraw_"+i).attr("checked","true");
        if (!$("#selectDraw_" + i).prop("checked"))
        {
            $("#selectDraw_" + i).prop("checked", true);
            setTimeout(checkSelected(i), 1000);
        }
        else {
            $("#myModal" + i).modal('show');
        }

        /**/
    }
    function checkSelected(i)
    {
        if (!$("#selectDraw_" + i).prop("checked"))
        {
            //$("#selectDraw_" + i).attr("checked", true);
            //$("#myModal" + i).modal('show');
            if (confirm("Range is out of selection. Do your wnat to remove the multiple selection!"))
            {
                for (j = 10; j < 20; j++)
                {
                    $("#selectDraw_" + j).attr("checked", false);
                }
            }
        }
        else {
            $("#myModal" + i).modal('show');
        }
    }
    function sumofqtyandamt() {
        var sumqty = 0;
        var sumamt = 0;
        for (var j = 10; j < 20; j++)
        {
            if ($("#qty_" + j).val() != "" && $("#amt_" + j).val() != "")
            {
                sumqty = sumqty + parseInt($("#qty_" + j).val());
                sumamt = sumamt + parseInt($("#amt_" + j).val());
            }
        }
        $("#tqty").val(sumqty);
        $("#tamt").val(sumamt);
        $("#selectyn").html("SELECT ALL");
        $("#selectyn").attr("onclick", "select('#selectyn','false')");
        $("#selectyn").prop("class", "btn btn-default btn-xs form-control");
        var ad = $("#adarr").val();

        var s = ad.split(",");
        var slenght = s.length;

        if (slenght > 1) {
            slenght = slenght - 1;
            var r = sumamt * slenght;
            $("#gtotal").val(r);
        } else {
            var r = sumamt * slenght;
            $("#gtotal").val(r);
        }
    }
    function sumofqtyandamtDTOP(flag, mid)
    {
        if (flag)
        {
            var sumqty = 0;
            var sumamt = 0;
            for (var j = 10; j < 20; j++)
            {
                if ($("#qty_" + j).val() != "" && $("#amt_" + j).val() != "")
                {
                    sumqty = sumqty + parseInt($("#qty_" + j).val());
                    sumamt = sumamt + parseInt($("#amt_" + j).val());
                }
            }
            $("#tqty").val(sumqty);
            $("#tamt").val(sumamt);
            for (var i = 0; i < 100; i++) {
                $("#e_" + mid + "_" + pn(i)).val("");
            }
            $("#totalqty_" + mid).val("");
            $("#totalamt_" + mid).val("");
            for (var i = 0; i < 10; i++) {
                $("#col_" + mid + "_" + i).val("");

            }
            var p = 0;
            for (var i = 0; i < 10; i++) {
                $("#row_" + mid + "_" + p).val("");
                p = p + 10;
            }
        } else {
            alert("Please Select Draw Numbers...!");
        }
        $("#selectyn").html("SELECT ALL");
        $("#selectyn").attr("onclick", "select('#selectyn','false')");
        $("#selectyn").prop("class", "btn btn-default btn-xs form-control");
        var ad = $("#adarr").val();

        var s = ad.split(",");
        var slenght = s.length;

        if (slenght > 1) {
            slenght = slenght - 1;
            var r = sumamt * slenght;
            $("#gtotal").val(r);
        } else {
            var r = sumamt * slenght;
            $("#gtotal").val(r);
        }
        return false;
    }
    function selectDraw()
    {
        var c = parseInt($("#tdraw").val());
        var n = parseInt($("#num").val());

        if (n <= c)
        {
            deselect();
            var data = "";
            for (var i = 1; i <= n; i++)
            {

                $("#ch" + i).prop("checked", true);
                data = data + $("#ch" + i).val() + ",";
            }
            $("#adarr").val(data);

        }
    }
    function deselect()
    {
        var c = $("#tdraw").val();
        for (var i = 0; i < c; i++)
        {

            $("#ch" + i).prop("checked", false);
        }
        $("#adarr").val("");
    }
    function lotoadselect(id, flag)
    {
        var i = 0;
        var c = $("#tdraw").val();
        if (flag.localeCompare("false") == 0) {
            $(id).html("DESELECT ALL");
            $(id).attr("onclick", "lotoadselect('#adloto','true')");
            $(id).prop("class", "btn btn-danger btn-xs ");
            for (i = 0; i < c; i++)
            {

                $("#ch" + i).prop("checked", true);
            }
        }
        else {

            $(id).html("SELECT ALL");
            $(id).attr("onclick", "lotoadselect('#adloto','false')");
            $(id).prop("class", "btn btn-default btn-xs ");
            for (var i = 0; i < c; i++)
            {

                $("#ch" + i).prop("checked", false);
            }
        }
        addrdaw(id);
        return false;
    }
    function select(id, flag)
    {
        var i = 0;
        if (flag.localeCompare("false") == 0) {
            $(id).html("DESELECT ALL");
            $(id).attr("onclick", "select('#selectyn','true')");
            $(id).prop("class", "btn btn-danger btn-xs form-control");
            for (i = 10; i < 20; i++)
            {

                $("#selectDraw_" + i).prop("checked", true);
            }
        }
        else {

            $(id).html("SELECT ALL");
            $(id).attr("onclick", "select('#selectyn','false')");
            $(id).prop("class", "btn btn-default btn-xs form-control");
            for (i = 10; i < 20; i++)
            {

                $("#selectDraw_" + i).prop("checked", false);
            }
        }
        return false;
    }

    function calamtspin(i)
    {
        var v = parseInt($("#p_" + i).val());
        if (isNaN(v)) {
            v = 0;
        }
        var p = v * 2;
        var qt = parseInt($("#tamt").val());
        if (isNaN(qt)) {
            qt = 0;
        }
        $("#tamt").val(qt + p);
    }
    function clearspin(i)
    {
        // $("#p_"+i).val("");
    }
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            //alert("Only Number Accept");
            return false;
        }
        return true;
    }
    function calclick(event, id)
    {

        var i = 0;
        var j = parseInt($("#points").val());
        if (($(id).val()).localeCompare("") == 0) {
            i = parseInt($("#points").val());

        } else {
            i = parseInt($(id).val());
            i = i + j;
        }
        $(id).val("0");

        switch (event.button) {
            case 0:

                $(id).val(i);

                break;
            case 2:
                $(id).val("");
                break;
            default:
                break;
        }
    }

    function deleteTick(disp, file, id)
    {
        $.post("/?r=" + file, {id: id}, function (dat) {
            //alert(dat);
            $(disp).html(dat);

        });
    }
    function printInvoice(id, file, display) {

        var tqt = parseInt($("#tqty").val());
        if (tqt <= 0)
        {
            alert("Invalid Quantity");
        } else {
            var formData = new FormData($(id)[0]);
            //onLoading();
            $("#sbtn").attr("value", "Please Wait....");
            $("#sbtn").attr("type", "button");
            $.post("/?r=<?php echo $obj->encdata("C_CheckBalance"); ?>", {amt: $("#tamt").val()}, function (d) {
                if (d.localeCompare("0") == 0)
                {
                    $.ajax({
                        type: "POST",
                        url: '/?r=' + file,
                        data: formData, //$("#studetnReg").serialize(), // serializes the form's elements.,
                        contentType: false,
                        processData: false,
                        success: function (data)
                        {
                            $("#sbtn").attr("value", "Print");
                            $("#sbtn").attr("type", "submit");
                            Popup(data);
                            //$("#printInvoiceContain").html(data);
                            /*$('#printInvoiceNew').modal({
                             show: 'false'
                             });*/
                            resetAllloto(id);
                            resetLotoClock();
                            $("#selectyn").html("SELECT ALL");
                            $("#selectyn").attr("onclick", "select('#selectyn','false')");
                            $("#selectyn").prop("class", "btn btn-default btn-xs form-control");
                            $.post("/?r=<?php echo $obj->encdata("C_GetLastLototTicket"); ?>", {}, function (dat) {
                                $("#C_Dashboard").html(dat);
                            });
                            $.post("/?r=<?php echo $obj->encdata("C_GetLastCancelLoto"); ?>", {}, function (dat) {
                                //alert(dat);
                                $("#C_DashboardC").html(dat);

                            });
                        }

                    });
                }
                else {
                    $("#sbtn").attr("value", "Print");
                    $("#sbtn").attr("type", "submit");
                    $("#dips").html("<h3 style='color:#FFF;'>Insuficent Fund..</h3>");
                    $("#loading").modal('toggle');
                    resetAll(id);
                }

            });
            return false;
        }
    }

    function movecol(event, mid, i)
    {
        switch (event.keyCode)
        {
            case 37:
                //console.log( $("#col_" + mid + "_" + t).val("test"));
                var t = i - 1;
                $("#col_" + mid + "_" + t).focus();
                break;
            case 39:
                // console.log(event.keyCode);
                var t = i + 1;
                $("#col_" + mid + "_" + t).focus();
                break;
        }
    }
    function moverow(event, mid, i)
    {
        switch (event.keyCode)
        {
            case 38:
                //console.log( $("#col_" + mid + "_" + t).val("test"));
                var t = i - 10;

                $("#row_" + mid + "_" + t).focus();
                break;
            case 40:
                // console.log(event.keyCode);
                var t = i + 10;


                $("#row_" + mid + "_" + t).focus();
                break;

        }
    }
    function change(event, i)
    {
        switch (event.keyCode)
        {
            case 37:
                i--;
                $("#p_" + i).focus();
                break;
            case 39:
                i++;
                $("#p_" + i).focus();
                break;
        }

    }
    function move(event, mid, i)
    {
        var lastdigit = ["09", "19", "29", "39", "49", "59", "69", "79", "89", "99"];

        switch (event.keyCode)
        {
            case 37:
                var t = i - 1;
                var sl = t.toString().length;
                if (sl === 1)
                {
                    t = "0" + t;
                }
                $("#e_" + mid + "_" + t).focus();
                //console.log($("#e_" + mid + "_" + t).val());
                break;

            case 38:
                var t = i - 10;
                var sl = t.toString().length;
                if (sl === 1)
                {
                    t = "0" + t;
                }
                $("#e_" + mid + "_" + t).focus();
                //console.log($("#e_" + mid + "_" + t).val());
                break;

            case 39:
                var t = i + 1;
                var sl = t.toString().length;
                if (sl === 1)
                {
                    t = "0" + t;
                }
                $("#e_" + mid + "_" + t).focus();
                //console.log($("#e_" + mid + "_" + t).val());
                break;
            case 40:
                var t = i + 10;
                var sl = t.toString().length;
                if (sl === 1)
                {
                    t = "0" + t;
                }
                $("#e_" + mid + "_" + t).focus();
                //console.log($("#e_" + mid + "_" + t).val());
                break;
            default:
                break;
        }
    }
    function printLastResult()
    {
        $.post("/?r=<?php echo $obj->encdata("C_LastResult"); ?>", {}, function (data) {
            Popup(data);
            draw();
        });
    }
    function spincal()
    {
        var p = 0;
        for (var i = 0; i < 10; i++)
        {
            var n = parseInt($("#p_" + i).val());

            if (!isNaN(n))
            {

                p = p + n;
            }

        }

        var t = p * 2;
        if (p == 0) {
            $("#totalpoint").val("");
        } else {
            $("#totalpoint").val(p);
        }
        if (t == 0) {
            $("#totalamount").val("");
        } else {
            $("#totalamount").val(t);
        }
        var ad = $("#adarr").val();

        var s = ad.split(",");
        var slenght = s.length;
        if (slenght > 1) {
            slenght = slenght - 1;
            var r = t * slenght;
            if (r == 0) {
                $("#gtotal").val("");
            } else {
                $("#gtotal").val(r);
            }
        } else {
            var r = t * slenght;
            if (r == 0) {
                $("#gtotal").val("");
            } else {
                $("#gtotal").val(r);
            }

        }

    }
    function clearDiv(id)
    {
        $(id).html("");
    }
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

</script>
<style type="text/css">
    /*
Description:
    Contains all the styles for the winning wheel page.
    
Verison History:
    2012-01-28, Douglas McKechie
    - Created based off earlier version.
    
    2015-09-26, Douglas McKechie
    - Minor updates for the 2.0 winwheel example.
    */

    body
    {
        font-family: arial;
    }

    /* Sets the background image for the wheel */
    td.the_wheel
    {
        background-image: url(./wheel_back.png);
        background-position: center;
        background-repeat: none;
    }

    /* Do some css reset on selected elements */
    h1, p
    {
        margin: 0;
    }

    div.power_controls
    {
        margin-right:70px;
    }

    div.html5_logo
    {
        margin-left:70px;
    }

    /* Styles for the power selection controls */
    table.power
    {
        background-color: #cccccc;
        cursor: pointer;
        border:1px solid #333333;
    }

    table.power th
    {
        background-color: white;
        cursor: default;
    }

    td.pw1
    {
        background-color: #6fe8f0;
    }

    td.pw2
    {
        background-color: #86ef6f;
    }

    td.pw3
    {
        background-color: #ef6f6f;
    }

    /* Style applied to the spin button once a power has been selected */
    .clickable
    {
        cursor: pointer;
    }

    /* Other misc styles */
    .margin_bottom
    {
        margin-bottom: 5px;
    }
    text{
        font-family:Helvetica, Arial, sans-serif;
        font-size:50px;

    }
    #chart{
        position:absolute;
        width:100px;
        height:100px;
        top:330px;
        left:-45px;
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }
    #question{
        position: absolute;
        width:50px;
        height:50px;
        top:50px;
        left:200px;
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
    #middleSpin{
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        transform: rotate(90deg);
    }
    #tend{
        position: fixed;


    }
</style>



<script src="j.js" type="text/javascript"></script>
<!-- <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>-->
<script type="text/javascript" charset="utf-8">
    var padding = {top: 20, right: 40, bottom: 0, left: 0},
    w = 350 - padding.left - padding.right,
            h = 360 - padding.top - padding.bottom,
            r = Math.min(w, h) / 2,
            rotation = 0,
            oldrotation = 0,
            picked = 10,
            oldpick = [],
            color = d3.scale.category20c();//category20c()
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

    var audio = new Audio('tick.mp3');  // Create audio object and load tick.mp3 file.

    function playSound()
    {
        // Stop and rewind the sound if it already happens to be playing.
        audio.pause();
        audio.currentTime = 0;
        audio.play();
    }
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
            .attr("id", "tend")
            .text(function (d, i) {
                return data[i].label;
            });





    //make arrow
    svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h / 2) + padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r * .40) + ",0L0," + (r * .08) + "L0,-" + (r * .08) + "Z")
            .style({"fill": "black"});

    //draw spin circle
    container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 80)
            .style({"fill": "#f1f1f1", "cursor": "pointer"});


    //spin text
    container.append("text")
            .attr("x", -2)
            .attr("y", 35)
            .attr("text-anchor", "middle")
            .attr("id", "middleSpin")
            .text("ॐ")
            .style({"font-weight": "bold", "font-size": "100px"});

</script>
</body>
</html>