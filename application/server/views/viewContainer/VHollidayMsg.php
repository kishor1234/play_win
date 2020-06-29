
<section class="content-header" style="margin-top: -60px;">
    <h1>
        Holiday Message
        <small>Create/Delete</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Holiday</a></li>
        <li class="active">Message Details Details</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div id="dismsg">

    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-warning">
                <div class="panel-body">
                    <form action="#" method="post" id="msgform" onsubmit="return formPost3('#msgform','<?php echo $obj->encdata("C_AddMessage");?>','#displayMessage')">
                        <div class="form-group">
                            <label>Enter HoliDay Message here <span id="require">*</span></label>
                            <textarea name="msg" id="msg" placeholder="Enter Holiday Message" required="" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Date<span id="require">*</span></label>
                            <input type="date" id="on_date" name="on_date" required="" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Message" class="btn btn-warning">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div  class="col-lg-12">
            <div class="form-group" id="displayMessage">
                <?php 
                    $main->isLoadView("VMsgTable",false,array());
                ?>
            </div>
        </div>
    </div>
    
</section><!-- /.content -->
