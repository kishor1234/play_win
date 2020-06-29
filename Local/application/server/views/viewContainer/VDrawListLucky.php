
<section class="content-header" style="margin-top: -60px;">
    <h1>
        Lucky Wheel Draw
        <small>list</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Draw</a></li>
        <li class="active">All Draw</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="form-group">
        <form action="#" method="post" id="myreport" onsubmit="return formPost3('#myreport', '<?php echo $obj->encdata("C_OpenLinkFalse") . "&v=" . $obj->encdata("VLuckyDrawData") . "&tk=0"; ?>', '#displayR')">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-lg-4">
                        <label style="float: right; margin-top: 10px;"><strong>Select Date : <spna style="color:red;">*</spna></strong></label>
                    </div>
                    <div class="col-lg-4">
                        <input type="date" name="cdate" id="cdate" class="form-control" autocomplete="off" required="">
                    </div>
                    <div class="col-lg-4">
                        <input type="submit" value="Search Data" class="btn btn-primary ">
                    </div>


                </div>
            </div>
        </form>
    </div>
    <!-- Your Page Content Here -->
    <br>
    <div class="container-fluid">
        <div id="displayR">

        </div>
    </div>

</section><!-- /.content -->
