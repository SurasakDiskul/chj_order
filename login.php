<?php session_start();?>
<?php include('./php/connect.php') ?>
<!-- Call Server -->
<!-- Call Server -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>CJL QC ReturnOrder</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!--CSS-->
    <link href="./js/T-11.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!--CSS end-->
    <style>
body {
  background-image: url('./js/bg.jpg');
  background-repeat: no-repeat;
  backdrop-filter: blur(2px);
  background-size: cover;
}
</style>
</head>

<body class="bg-body">

<!--Content Start-->
    <div class="container-fluid position-relative d-flex p-0 ">        
        <div class="container-fluid">
                       
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                        
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">
                    <div class="bg-secondary rounded p-4 p-sm-5 ">
                        <div class="d-flex align-items-center justify-content-between text-center">
                            </div>
                                <div class="text-center">
                                <img src="./js/cj.jpg" width="250" height="275" class="align-items-center">
                                    <p class="h4 text-primary mb-4" style="font-size:26px" ><b>บันทึกการคืนเคลมสินค้า</b> </p>
                                </div>
                    <!--ประกาศให้ Form นี้ทำงานจาก check_login.php-->
                        <form action="check_login.php" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control " name="user_id" placeholder="Username" required>
                            </div>
                            <br>
                            <div class="form-group">
                            <input type="password" class="form-control " name="user_password" placeholder="Password" required>
                            </div>
                            <hr>
                            <div class="text-center">
                            <button type="submit" name="login" class="btn btn-primary  btn-block">
                                Login
                            </button>
                        <a class="btn btn-outline-info" href="./คู่มือการใช้งาน.pdf" target="_blank">
                            <i class="fas fa-folder">
                            </i>
                            คู่มือ
                        </a> 
                           </div>
                        </form>
                    <!--Form End-->
                    </div>  
                </div>
            </div>
         </div>
    </div>
<!--Content End-->
    
        <!--script-->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="lib/chart/chart.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="lib/tempusdominus/js/moment.min.js"></script>
            <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
            <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
            <script src="js/main.js"></script>
        <!--script-->
</body>

</html>