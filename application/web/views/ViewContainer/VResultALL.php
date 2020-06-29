
<section class="content-header">
    <h1>
        Report's
        <small>Daily Reports</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/?r=<?php echo $obj->encdata("C_Dashboard1"); ?>"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
        <li class="active"><a href="#">Result</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <form action="javascript:void(0)"  method="post" id="myreport" onsubmit="return formPost3('#myreport', '<?php echo $obj->encdata("C_ResultReport"); ?>', '#reportresult')">
                <div class="form-group">
                    <div class="col-lg-1">
                        <label style="margin-top: 10px; font-size: 14px;"><strong>Select Game </strong></label>
                    </div>
                    <div class="col-lg-2">
                        <select name="gameid" id="gameid" required="" class="form-control">
                            <option value="0">Loto</option>
                            <option value="1">Lucky Wheel</option>
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <label style="margin-top: 10px; font-size: 14px;"><strong >To Date </strong></label>
                    </div>
                    <div class="col-lg-2">
                        <input type="date" name="tdate" required="" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-success" ><i class="fa fa-search"></i> Get Result</button> 
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="reportresult">

    </div>

</section><!-- /.content -->
