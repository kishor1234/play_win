

<div id="loading" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <center>    <img src="/assets/img/loadin.gif" alt="" style="height: 100px;"/>
        </center>

    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<script>
    var loadingimg = '<center><img src="https://d15omoko64skxi.cloudfront.net/wp-content/uploads/2017/07/avatar-black.gif" alt="Loading...."></center>';

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
    function ReprintPostFromReport(fid, file, display, i)
    {
        $(display).html(loadingimg);
        $.post("/?r=" + file, {id: i}, function (data) {

            $(display).html(data);
        });
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
    function paytypeChange()
    {
        var ch = $("#paytype").val();
        switch (ch)
        {
            case "Cash":
                var net = $("#netamount").val();
                $("#payed").val(net);
                $("#remain").val(0);
                $("#chaqueno").attr("readonly", true);
                $("#chaqueno").attr("required", false);
                $("#userid").attr("required", false);
                $("#payed").attr("readonly", true);

                break;
            case "Credit":
                var net = $("#netamount").val();
                $("#payed").val(net);
                $("#remain").val(0);
                $("#chaqueno").attr("readonly", true);
                $("#chaqueno").attr("required", false);
                $("#userid").attr("required", true);
                $("#payed").attr("readonly", true);

                break;
            case "Chaque":
                var net = $("#netamount").val();
                $("#payed").val(net);
                $("#remain").val(0);
                $("#chaqueno").attr("readonly", false);
                $("#chaqueno").attr("required", true);
                $("#userid").attr("required", false);
                $("#payed").attr("readonly", true);

                break;

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
                alert(data);
                $(display).html(data);
                printMsg(display);
                //alert(data); // show response from the php script.
            }

        });

        //$(id)[0].reset();
        return false;
    }
    function formPost3(id, file, display)
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
                //$('#myWin').modal('show');

                $(display).html(data);
                printMsg("#msg");

            }

        });

        $(id)[0].reset();
        return false;
    }

    function removeProduct(id, file, dispaly)
    {
        if (confirm("Are you sure you want to delete this Product?")) {
            onLoading();
            $.post("/?r=" + file, {id: id}, function (data) {
                offLoading();
                $(dispaly).html(data);
                printMsg("#msg");
            });
        } else {
            return false;
        }

    }
    function deleteitemfrompcart(file, id, display)
    {
        if (confirm("Are you surer, you want to delete item?"))
        {
            onLoading();
            $.post("/?r=" + file, {id: id}, function (data) {
                offLoading();
                $(display).html(data);
                $.post("/?r=<?php echo $obj->encdata("C_OpenLink") . "&v=" . $obj->encdata("Vngttotal"); ?>", {}, function (dat) {
                    $("#table_display").html(dat);
                    $.post("/?r=<?php echo $obj->encdata("C_OpenLink") . "&v=" . $obj->encdata("printTotal"); ?>", {}, function (d) {
                        $("#totalamount").html(d);
                        $("#amountf").val(d);
                    });
                });
                printMsg("#msg");
            });

        }
    }
    function searchProduct()
    {
        var key = $("#keyword").val();
        //onLoading();
        $.post("/?r=<?php echo $obj->encdata("C_OpenLink_2") . "&v=" . $obj->encdata("VProductSearch"); ?>", {key: key}, function (data) {
            //  offLoading();
            $("#ctable").html(data);
        });
    }
    function changetype()
    {
        var str1 = $("#paytype").val();
        var amt = $("#amountf").val();
        var s = str1.localeCompare("Cash");
        if (s === 0)
        {
            $("#payedamt").val(amt);
            //$("#payedamt").attr("readonly","");
            $("#remainamt").val(0);
        }
        else {
            $("#payedamt").val("0");
            // $("#payedamt").removeAttribute("readonly");
            $("#remainamt").val(amt);
        }
    }
    function calc()
    {
        var a = parseInt($("#payedamt").val());
        var c = parseInt($("#amountf").val());
        var b = c - a;

        if (b < 0)
        {
            alert("Enter Valid Amount");
            $("#payedamt").val(0);
            $("#remainamt").val(c);
        } else {
            $("#remainamt").val(b);
        }
    }
    function onInput(id, list, display, file) {

        var val = $(id).val();
        var opts = $(list).children();//.childNodes;
        //onLoading();
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                $.post("/?r=" + file, {master: opts[i].value}, function (data) {
                    // offLoading();
                    $(display).html(data);
                });

                break;
            }
        }
    }
    function getDrawLoto(id, list) {

        var val = $(id).val();
        var opts = $(list).children();//.childNodes;
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                var res = opts[i].value.split("|");
                $("#gameid").val(res[0]);
                $("#stime").val(res[1]);
                $("#etime").val(res[2]);
                $.post("/?r=<?php echo $obj->encdata("C_GetDrawLoadLoto");?>",{id:res[0]},function(d){
                    $("#display").html(d);
                    
                });
                break;
            }
        }
    }
    function getDraw(id, list) {

        var val = $(id).val();
        var opts = $(list).children();//.childNodes;
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                var res = opts[i].value.split("|");
                $("#gameid").val(res[0]);
                $("#stime").val(res[1]);
                $("#etime").val(res[2]);
                break;
            }
        }
    }
    function getSupplier(id, list) {

        var val = $(id).val();
        var opts = $(list).children();//.childNodes;
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                var res = opts[i].value.split("|");
                $("#userid").val(res[1]);
                $("#user").val(res[0]);
                $("#gstno").val(res[2]);
                break;
            }
        }
    }

    function getUser(id, list) {
        var val = $(id).val();
        var opts = $(list).children();//.childNodes;
        var ft = false;
        var net = $("#netamount").val();
        $("#payed").val(net);
        $("#remain").val(0);
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                var res = opts[i].value.split("|");
                $("#username").val(res[1]);
                $("#userid").val(res[0]);
                fl = true;
                ft = true;
                var paytype = $("#paytype").val();
                switch (paytype)
                {
                    case "Cash":
                        $("#payed").attr("readonly", true);
                        break;
                    case "Credit":
                        $("#payed").attr("readonly", false);
                        break;
                    default:
                        $("#payed").attr("readonly", true);
                        break;
                }

                break;
            }
        }
        if (ft === false) {
            $("#payed").attr("readonly", true);
            $("#userid").val("");
        }
    }
    function getDateWiseInvoiceReport(id, file, display)
    {
        var from = $("#from").val();

        onLoading();
        $.post("/?r=" + file, {from: from}, function (data) {
            offLoading();

            $(display).html(data);
        });
        return false;
    }
    function getDaywiseinvoicereport(file, display)
    {
        var from = $("#from").val();
        var to = $("#to").val();
        onLoading();
        $.post("/?r=" + file, {from: from, to: to}, function (data) {
            offLoading();

            $(display).html(data);
        });
        return false;
    }
    function addtoCart(file, display)
    {
        //alert(file);
        $.post("/?r=" + file,
                {
                    master: $("master").val(),
                    job: $("job").val(),
                    height: $("height").val(),
                    width: $("width").val(),
                    sqr: $("sqr").val(),
                    dtp: $("dtp").val(),
                    other: $("other").val(),
                    total: $("total").val()},
        function (data) {
            $(display).val(data);
        });
    }
    function calclu(i)
    {
        var amount = parseFloat($("#amount" + i).val());
        var pay = parseFloat($("#pay" + i).val());
        if (pay > amount) {
            $("#pay" + i).val("");
            $("#remain" + i).val("0");
            alert("Invalid Amount");
        } else {
            if (pay <= 0)
            {
                $("#pay" + i).val("");
                $("#remain" + i).val("0");
                alert("Invalid Amount");
            } else {
                var remain = amount - pay;
                $("#remain" + i).val(remain);
                $("#submit" + i).val("Proceed to Collect " + pay);
            }
        }
    }
    function collectPayment(i, display, formid, file)
    {
        $.post("/?r=" + file, {userid: $("#uid" + i).val(), camt: $("#amount" + i).val(), paid: $("#pay" + i).val(), remain: $("#remain" + i).val()}, function (data) {
            $(display + i).html(data);
            $(formid)[0].reset();
        });
        return false;
    }
    function deleteSupplier(id)
    {
        $.post("/?r=<?php echo $obj->encdata("C_DeleteSupplier"); ?>", {id: id}, function (data) {
            $("#msgg").html(data);
        });
    }
    function ResultServices(id)
    {
        $.post("/?r=<?php echo $obj->encdata("C_StartorStop"); ?>", {rstatus: id}, function (data) {
            $("#rs").html(data);
        });
    }
    function cal()
    {

        var rate = $("#rate").val();
        var qty = $("#qty").val();

        if (isNaN(rate) || isNaN(qty))
        {
            alert("Input Must be Number only...!");
            $("#total").val(0.0);
            return false;
        }
        else
        {
            var total = parseFloat(rate) * parseFloat(qty);
            $("#nettotal").val("" + total);

        }
    }
    function add()
    {
        alert("data");
        $.post("/?r=<?php echo $obj->encdata("C_AddPurchasitemtoCart"); ?>", {product: $("#product").val(), rate: $("#rate").val(), qty: $("#qty").val(), total: $("#nettotal").val()}, function (data) {
            $("#ptable").html(data);
        });
        return false;
    }
    function removeItemPcart(id, product)
    {
        $.post("/?r=<?php echo $obj->encdata("C_RemovePCart"); ?>", {id: id, product: product}, function (data) {
            $("#ptable").html(data);
        });
    }
    function calGST()
    {

    }
    function calSqr()
    {
        var prate = $("#srate").val();
        var qty = $("#qty").val();
        if (isNaN(qty)) {
            alert("Only number can accept..!");
            $("#qty").val("");
        } else if (qty < 0) {
            alert("Only Positive Number can acept!");
            $("#qty").val("");
        } else {
            var tt = prate * qty;
            $("#nettotal").val(tt);
        }


    }

    function replaceZero(number)
    {
        if (number >= 0) {
            return number;
        } else {
            return 0;
        }

    }
    function getJOB(id, list, display, file) {

        var val = $(id).val();
        var opts = $(list).children();//.childNodes;
        //onLoading();
        for (var i = 0; i < opts.length; i++) {
            if (opts[i].value === val) {
                $.post("/?r=" + file, {master: opts[i].value}, function (data) {

                    $(display).html(data);
                });

                break;
            }
        }
    }
    function getRate(id, list) {

        var val = $(id).val();

        var opts = $(list).children();//.childNodes;
        //onLoading();
        for (var i = 0; i < opts.length; i++) {

            if (opts[i].value === val) {
                var s = opts[i].value.split("|");
                $("#id").val(s[0]);
                $(id).val(s[1]);
                $("#marathi").val(s[2]);
                $("#prate").val(s[3]);
                $("#srate").val(s[4]);
                $("#mrp").val(s[5]);
                $("#size").val(s[6]);
                $("#unit").val(s[7]);

                break;
            }
        }
    }
    function postClaim(file, id)
    {
        $.post("/?r=" + file, {id: id}, function (data) {
            Popup(data);
        });
    }
    function postUrlData(file, display, id)
    {
        //alert(display);
        onLoading();
        $.post("/?r=" + file, {id: id}, function (data) {
            offLoading();
            $(display).html(data);
            $.post("/?r=<?php echo $obj->encdata("C_GETTotal"); ?>", {}, function (dat) {

                var d = dat.split("|");
                $("#ntotal").val(d[0]);
                $("#gtotal").val(d[1]);
                $("#total").val(Math.round(d[2]));
                $("#netamount").val(Math.round(d[2]));
                $("#gtot").val(d[1]);
                $("#ntot").val(d[0]);
            });
            printMsg("#msg");
        });
        return false;
    }
    function searchUser(file, display)
    {
        var keyword = $("#keyword").val();

        $.post("/?r=" + file, {keyword: keyword}, function (data) {

            $(display).html(data);
        });
    }
    function ajaxLinkCall(file, display)
    {
        onLoading();
        $.post("/?r=" + file, {id: 1}, function (data) {
            offLoading();
            $(display).html(data);
        });
    }
    function GenerateBarcode(id)
    {
        $.post("/?r=<?php echo $obj->encdata('C_GenerateBarcode'); ?>", {id: id}, function (data) {
            $("#barcode" + id).val(data);
        });
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
    function Popup(data) {
        var mywindow = window.open();
        mywindow.document.write(data);
        mywindow.print();
        mywindow.close();
        return true;
    }

</script>
<script type="text/javascript">
    function clocks(clock, t)
    {
        if (t < 0) {
            t = 0;
            setTimeout(draw, 60000);
        }

        clock = $('.clock').FlipClock(t, {
            clockFace: 'MinuteCounter',
            countdown: true,
            callbacks: {
                stop: function () {
                    $("#result").html(loadingImage);
                    //spin();
                    //calLuckyNumber();


                }
            }
        });

    }
    function clocksSpin(clock, t,event)
    {
        if (t < 0) {
            t = 0;
            setTimeout(drawSpin, 60000);
        }

        clock = $('.clockSpin').FlipClock(t, {
            clockFace: 'MinuteCounter',
            countdown: true,
            callbacks: {
                stop: function () {
                    $("#result").html(loadingImage);
                    //spin();
                    drawSpin();
                    //calLuckyNumber();


                }
            }
        });

    }
    function calLuckyNumber()
    {
        $.post("/?r=<?php echo $obj->encdata("C_GetLuckyNumbers"); ?>", {}, function (data) {

            //$("#result").html(data);
            draw();
            //clocks(clock, obj.time);
        });
    }
    function drawSpin()
    {
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRoundSpin"); ?>", {}, function (data) {
            var obj = jQuery.parseJSON(data);

            clocksSpin(clock, obj.time);

        });
    }
    function draw()
    {
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRound"); ?>", {}, function (data) {
            var obj = jQuery.parseJSON(data);

            clocks(clock, obj.time);

        });
    }
    var clock;

    $(document).ready(function () {
        setInterval(function () {
            $.post("/?r=<?php echo $obj->encdata("C_CheckLogin"); ?>", {id: 1}, function (data) {
                switch (data) {
                    case "0":
                        //console.log("success");
                        break;
                    case "1":
                        location.reload();
                        break;
                }
            });
        }, 3000);
        // callCanvas();
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRound"); ?>", {}, function (data) {
            //alert(data);    
            var obj = jQuery.parseJSON(data);
            $("#gid").html(obj.id);
            $('#stime').html(obj.stime);
            $("#etime").html(obj.etime);
            clocks(clock, obj.time);
        });
        $.post("/?r=<?php echo $obj->encdata("C_UpdateGameRoundSpin"); ?>", {}, function (data) {
            //alert(data);    
            var obj = jQuery.parseJSON(data);
            //$("#gid").html(obj.id);
            //$('#stime').html(obj.stime);
            //$("#etime").html(obj.etime);
            clocksSpin(clock, obj.time);
        });


    });

    function postURL3(file, display, id)
    {
        var limit = $("#limit").val();
        onLoading();
        $.post("/?r=" + file, {id: id, limit: limit}, function (data) {
            offLoading();

            $(display).html(data);
            return false;
        });

    }
    function printMessage(file, display)
    {
        $.post("/?r=" + file, {}, function (data) {
            $(display).html(data);
        });
    }
    function SearchByName(file, display)
    {
        var id = $("#keyword").val();
        //onLoading();
        $.post("/?r=" + file, {id: id}, function (data) {
            //offLoading();
            $(display).html(data);
            $("#msg").show();
            printMessage('C_PrintMessage', "#msg");
        });
        return false;
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
    function onlyAlphabets(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else {
                return true;
            }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
                return true;
            else
                return false;
        }
        catch (err) {
            alert(err.Description);
        }
    }
    function onlyAlphabetswithspace(e, t) {
        try {
            if (window.event) {
                var charCode = window.event.keyCode;
            }
            else if (e) {
                var charCode = e.which;
            }
            else {
                return true;
            }
            if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32)
                return true;
            else
                return false;
        }
        catch (err) {
            alert(err.Description);
        }
    }
    function loadBalance() {
        $.post("?r=<?php echo $obj->encdata('C_DisplayAdminBalance'); ?>", {}, function (d) {
            $("#bal").html(d);
            console.log(d);
        });
    }
    setInterval(loadBalance, 9000);
</script>

<script>
    function addrow(i, mid)
    {
        var num = parseInt($("#row_" + mid + "_" + i).val());
        if (isNaN(num)) {
            for (var k = 0; k < 10; k++)
            {
                $("#e_" + mid + "_" + (k + i)).val("");
            }
        }
        else {
            for (var k = 0; k < 10; k++)
            {
                var value = $("#col_" + mid + "_" + k).val();
                if (value.localeCompare("") != 0) {
                    $("#e_" + mid + "_" + (k + i)).val(num + parseInt(value));
                }
                else {
                    $("#e_" + mid + "_" + (k + i)).val(num);
                }
            }
        }
        calNumber(mid);
    }
    function addcol(i, mid)
    {
        var num = parseInt($("#col_" + mid + "_" + i).val());
        if (isNaN(num)) {
            $("#e_" + mid + "_" + (i)).val("");
            var t = i;
            for (var k = 1; k < 10; k++)
            {
                t = t + 10;
                $("#e_" + mid + "_" + (t)).val("");
            }
        }
        else {
            var t = i;
            var r = 10;
            for (var k = 0; k < 10; k++)
            {
                var value = $("#row_" + mid + "_" + (k * 10)).val();
                if (value.localeCompare("") != 0) {
                    $("#e_" + mid + "_" + (t)).val(num + parseInt(value));
                }
                else {
                    $("#e_" + mid + "_" + (t)).val(num);
                }
                r = r + 10;
                t = t + 10;
            }
        }
        calNumber(mid);
    }
    function calNumber(mid)
    {
        var sumofPoint = 0;
        //alert($("#e_"+mid+"_"+1).val());
        for (i = 0; i < 100; i++)
        {
            var n = $("#e_" + mid + "_" + i).val();
            if (n.localeCompare("") != 0)
            {

                sumofPoint = sumofPoint + parseInt(n);
                //console.log(sumofPoint);
            }
            // sumofPoint=sumofPoint;
        }

        $("#totalqty_" + mid).val(sumofPoint);
        $("#totalamt_" + mid).val(sumofPoint * 2);
        return false;
    }
    function clearAll(mid)
    {

        for (i = 0; i < 100; i++)
        {
            $("#e_" + mid + "_" + i).val("");
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
        return false;
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
        sumofqtyandamtDTOP(flag, mid);

        return false;
    }
    function openDraw(i)
    {
        //$("#selectDraw_"+i).attr("checked","true");
        if (!$("#selectDraw_" + i).prop("checked"))
        {
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

        /**/
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
                $("#e_" + mid + "_" + i).val("");
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
    function printInvoice(id, file, display) {
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
                
                Popup(data);
                resetAll(id);
                $("#selectyn").html("SELECT ALL");
                $("#selectyn").attr("onclick", "select('#selectyn','false')");
                $("#selectyn").prop("class", "btn btn-default btn-xs form-control");

            }

        });


        return false;
    }
    function clearBtn()
    {
        for (var i = 10; i < 20; i++)
        {
            $("#btn_" + i).val("");
        }
    }
    function resetAll(id)
    {
        $(id)[0].reset();
        clearBtn();
        return false;
    }
</script>
<script>
    $(function () {
        var setCookie,
                removeCookie,
                // Create constants for things instead of having same string
                // in multiple places in code.
                COOKIE_NAME = 'TabOpen',
                SITE_WIDE_PATH = {path: '/'};
        setCookie = function () {
            $.cookie(COOKIE_NAME, '1', SITE_WIDE_PATH);
        };
        removeCookie = function () {
            $.removeCookie(COOKIE_NAME, SITE_WIDE_PATH);
        };
        // We don't need to wait for DOM ready to check the cookie
        if ($.cookie(COOKIE_NAME) === undefined) {

            setCookie();
            $(window).unload(removeCookie);
        } else {
            // Replace the whole body with an error message when the DOM is ready.
            $(function () {
                $('body').html('<div class="error">' +
                        '<h1>Sorry!</h1>' +
                        '<p>You can only have one instance of this web page open at a time.</p>' +
                        '</div>');
            });
        }
    });
    function viewData(i, display, id)
    {
        $(display).html(loadingimg);
        $.post("/?r=<?php echo $obj->encdata("C_ViewLoad"); ?>", {id: id}, function (data) {
            $(display).html(data);
        });
        return false;
    }
    function viewDataLucky(i, display, id)
    {
        $(display).html(loadingimg);
        $.post("/?r=<?php echo $obj->encdata("C_ViewLoadLucky"); ?>", {id: id}, function (data) {
            $(display).html(data);
        });
        return false;
    }
    function GetResultLoto(display, file, id)
    {
        $(display).html("<p>Please wait......</p>");
        $.post("/?r=" + file, {id: id}, function (data) {
            $("#displayDraw").html(data);
            $.post("/?r=<?php echo $obj->encdata("C_GetLastUpdateResult"); ?>", {id: id}, function (data) {

                $(display).html(data);
            });
        });
    }
    function GetResultLucky(display, file, id)
    {
        $(display).html("<p>Please wait......</p>");
        $.post("/?r=" + file, {id: id}, function (data) {
            $("#displayDraw").html(data);
            $.post("/?r=<?php echo $obj->encdata("C_GetLastUpdateResultLucky"); ?>", {id: id}, function (data) {

                $(display).html(data);
            });
        });
    }
</script>
</body>
</html>