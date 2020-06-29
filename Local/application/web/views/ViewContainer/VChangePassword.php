
<section class="content-header">
    <h1>
        Change Password
        <small>User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/?r=<?php echo $obj->encdata("C_Dashboard1"); ?>"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
        <li class="active"><a href="#">Change Password</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <fieldset>
                        <legend>Change Password</legend>
                        <form action="/?r=<?php echo $obj->encdata("C_ChangePassword");?>" method="post" id="myShopInfo" onsubmit="">
                            <div class="form-group">
                                <label> Old Password <span id="require">*</span></label>
                                <input type="password" name="op" id="op" placeholder="Old Password" class="form-control" required="" autocomplete="off" >
                            </div>
                            <div class="form-group">
                                <label> New Password <span id="require">*</span></label>
                                <input type="password" name="np" id="np" placeholder="Enter New Password" class="form-control" required="" autocomplete="off" >
                            </div>
                            <div class="form-group">
                                <label> Confirm Password <span id="require">*</span></label>
                                <input type="password" name="cp" id="cp" placeholder="Re-Enter Password" class="form-control" required="" autocomplete="off">
                            </div>
                            
                            <div class="form-group">
                                <input type="text" name="id" id="id" value="<?php echo $_SESSION["userid"];?>" class="form-control" required="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Update Data" class="btn btn-primary btn-sm">
                            </div>
                            
                        </form>
                    </fieldset>
        </div>
    </div>
    <div id="reportresult">

    </div>

</section><!-- /.content -->
