<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-primary">

            <div class="panel-body">
                <legend>Create ID</legend>
                <div id="diss"></div>
                <form action="#" method="post" id="myid" onsubmit="return formPost('#myid', '<?php echo $obj->encdata("C_CreateID"); ?>', '#diss')">
                    <div class="form-group">
                        <label>User Name <span id="require">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Enter Full Name" style="text-transform:uppercase" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Mobile No. <span id="require">*</span></label>
                        <input type="text" name="mobileno" maxlength="10" onkeypress="return isNumber(event)" id="mobileno" placeholder="Mobile Number *" pattern="\d{10}" required="" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Point's <span id="require">*</span></label>
                        <input type="number" name="balance" id="balance" placeholder="Enter Startup Point's *" class="form-control" required="" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary btn-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
