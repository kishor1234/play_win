<html>
    <head>
        <title>
            Login
        </title>
        <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <script src="/assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            #require{color:red;}
            body{
                background-color: #F7E29C;
                //color:#ffffff;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <center>
                    <?php
                    if (!empty($_SESSION["msg"])) {
                        echo '<div class="col-lg-4 col-lg-offset-4">';
                        echo $main->printMessage($_SESSION["msg"], "danger");
                        echo "</div>";
                        $_SESSION["msg"] = "";
                    }
                    ?>
                </center>
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="panel panel-primary" style="margin-top:150px; opacity: 0.9;">
                        <div class="panel-body">
                            <fieldset>
                                <legend>Login</legend>
                                <form action="/?r=<?php echo $obj->encdata("C_LoginProcess"); ?>" method="post" id="MyLogin">
                                    <div class="form-group">
                                        <label>Username <span id="require">*</span></label>
                                        <input type="text" name="username" id="username" class="form-control" autocomplete="off" required="" placeholder="Username" >
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span id="require">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" autocomplete="off" required="" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="login" id="login" value="Login" class="btn btn-primary">
                                        <input type="button" class="btn btn-danger btn-sm" id="reset" value="Reset">
                                    </div>
                                </form>

                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
<?php include "Layout/modal.php";?>        
<script>
    $("document").ready(function () {
        $("#reset").click(function () {
            $("#email").val("");
            $("#pwd").val("");
        });
    });
</script>
</body>
</html>