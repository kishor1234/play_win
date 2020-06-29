
<section class="content-header" style="margin-top: -60px;">
    <h1>
        ADD ADMIN POINT
        <small>POINTS</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> ADMIN</a></li>
        <li class="active">ADD POINT'S</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div id="dismsg">

            </div>
            <div class="form-group">
                <form action="javascript:void(0)" method="post" onsubmit="return formPost3('#myadmingbalance', '<?php echo $obj->encdata("C_AddAdminBalance"); ?>', '#dismsg')" id="myadmingbalance" class="form-horizontal">
                    <div class="form-group">
                        <label>ENTER POINT'S  <span>*</span></label>
                        <input type="number" value="0.0" name="balance" id="balance" placeholder="Enter Amount" class="form-control" required="">
                    </div>
                    <div class="form-group">

                        <input class="col-lg-2" type="button" value="+50"  onclick="addBalance(50)" class="btn btn-default btn-sm form-group">
                        <input class="col-lg-2" type="button" value="+100" onclick="addBalance(100)" class="btn btn-default btn-sm form-group">
                        <input class="col-lg-2" type="button" value="+200" onclick="addBalance(200)" class="btn btn-default btn-sm form-group">
                        <input class="col-lg-2" type="button" value="+500" onclick="addBalance(500)" class="btn btn-default btn-sm form-group">
                        <input class="col-lg-2" type="button" value="+1000" onclick="addBalance(1000)" class="btn btn-default btn-sm form-group">
                        <input class="col-lg-2" type="button" value="+2000" onclick="addBalance(2000)" class="btn btn-default btn-sm form-group">


                    </div>
                    <div class="form-group">
                        <input type="submit" value="UPDATE POINT'S" class="btn btn-success">
                    </div>
                </form>
            </div>
            <script>
                function addBalance(i)
                {
                    var main = parseFloat($("#balance").val());
                    $("#balance").val(main + i);
                    return false;
                }
            </script>
        </div>
    </div>
</section><!-- /.content -->
