<html>
    <head>
        <title>
           404 Page not found
        </title>
        <link href="/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <script src="/assets/js/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <style>
            #require{color:red;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <center>
                    <?php 
                        if(!empty($_SESSION["msg"])){
                            
                            echo $_SESSION["msg"]; 
                           
                            $_SESSION["msg"]="";
                        }
                    ?>
                </center>
                <div class="col-lg-12">
                    <div class="panel" style="margin-top:50px;">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-lg-4">
                                     <h1>Oops!</h1>
                            <h3>We can't seem to find the <br> page you're looking for.</h3>
                                </div>
                                <div class="col-lg-8">
                                    
                                    <img src="assets/404.jpg" alt=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>
      
    </body>
</html>