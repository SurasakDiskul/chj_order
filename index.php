<?php 
session_start();
$levels = $_SESSION["status_login"];
if($_SESSION["status_login"] == ''){
    echo '<script>
    setTimeout(function() {
     swal({
         title: "โปรดเข้าสู่ระบบก่อนใช้งาน!",
         text: "ท่านต้องการไปหน้า Login หรือไม่.",
         type: "warning",
         showConfirmButton: true
     }, function() {
         window.location = "login.php"; 
     });
    }, 1000);
    </script>';
}elseif ($_SESSION["status_login"] == 'admin1' or 'admin2' or 'admin3' or 'admin4') {
?>
<?php include('./php/connect.php');?>
<?php 
//<!-----------------------------------------------------1----------------------------------------------------->

    $res = mysqli_query($conn,'SELECT ROUND(sum(price),2) FROM tbproadd');
    $row = mysqli_fetch_row($res);
    $sum = $row[0];

//<!-----------------------------------------------------1----------------------------------------------------->
?>

<?php 
//<!-----------------------------------------------------2----------------------------------------------------->

    $res1 = mysqli_query($conn,'SELECT remark, SUM( quantity )FROM `tbproadd`GROUP BY remark ORDER BY SUM( quantity ) DESC LIMIT 1;');
    $row1 = mysqli_fetch_row($res1);
    $sum1 = $row1[0];

//<!-----------------------------------------------------2----------------------------------------------------->
?>

<?php 
//<!-----------------------------------------------------3----------------------------------------------------->

    $res2 = mysqli_query($conn,'SELECT customername, SUM( amount )FROM `tbcro` GROUP BY customername ORDER BY SUM( amount ) DESC LIMIT 1;');
    $row2 = mysqli_fetch_row($res2);
    $sum2 = $row2[0];

//<!-----------------------------------------------------3----------------------------------------------------->
?>

<?php 
//<!-----------------------------------------------------4----------------------------------------------------->

    $res3 = mysqli_query($conn,'SELECT barcode, SUM(quantity) FROM `tbproadd`GROUP BY barcode ORDER BY `SUM(quantity)` DESC LIMIT 1;');
    $row3 = mysqli_fetch_row($res3);
    $sum3 = $row3[0];

//<!-----------------------------------------------------4----------------------------------------------------->
?>

<!--chart data-->

<?php
//<!-----------------------------------------------------0----------------------------------------------------->

$sql_m1="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-01-01' AND '2566-01-31'";
$result_m1 = mysqli_query($conn,$sql_m1);
$row_m1 = mysqli_fetch_assoc($result_m1);

//<!-----------------------------------------------------1----------------------------------------------------->

$sql_m2="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-02-01' AND '2566-02-29'";
$result_m2 = mysqli_query($conn,$sql_m2);
$row_m2 = mysqli_fetch_assoc($result_m2);

//<!-----------------------------------------------------2----------------------------------------------------->

$sql_m3="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-03-01' AND '2566-03-31'";
$result_m3 = mysqli_query($conn,$sql_m3);
$row_m3 = mysqli_fetch_assoc($result_m3);

//<!-----------------------------------------------------3----------------------------------------------------->   

$sql_m4="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-04-01' AND '2566-04-30'";
$result_m4 = mysqli_query($conn,$sql_m4);
$row_m4 = mysqli_fetch_assoc($result_m4);

//<!-----------------------------------------------------4----------------------------------------------------->   

$sql_m5="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-05-01' AND '2566-05-31'";
$result_m5 = mysqli_query($conn,$sql_m5);
$row_m5 = mysqli_fetch_assoc($result_m5);

//<!-----------------------------------------------------5----------------------------------------------------->

$sql_m6="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-06-01' AND '2566-06-30'";
$result_m6 = mysqli_query($conn,$sql_m6);
$row_m6 = mysqli_fetch_assoc($result_m6);

//<!-----------------------------------------------------6----------------------------------------------------->

$sql_m7="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-07-01' AND '2566-07-31'";
$result_m7 = mysqli_query($conn,$sql_m7);
$row_m7 = mysqli_fetch_assoc($result_m7);

//<!-----------------------------------------------------7----------------------------------------------------->   

$sql_m8="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-08-01' AND '2566-08-31'";
$result_m8 = mysqli_query($conn,$sql_m8);
$row_m8 = mysqli_fetch_assoc($result_m8);

//<!-----------------------------------------------------8----------------------------------------------------->

$sql_m9="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-09-01' AND '2566-09-30'";
$result_m9 = mysqli_query($conn,$sql_m9);
$row_m9 = mysqli_fetch_assoc($result_m9);

//<!-----------------------------------------------------9----------------------------------------------------->    

$sql_m10="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-10-01' AND '2566-10-31'";
$result_m10 = mysqli_query($conn,$sql_m10);
$row_m10 = mysqli_fetch_assoc($result_m10);

//<!-----------------------------------------------------10----------------------------------------------------->    

$sql_m11="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-11-01' AND '2566-11-30'";
$result_m11 = mysqli_query($conn,$sql_m11);
$row_m11 = mysqli_fetch_assoc($result_m11);

//<!-----------------------------------------------------11----------------------------------------------------->

$sql_m12="SELECT COALESCE(sum(amount), '0') as amount FROM tbcro
WHERE datecro BETWEEN '2566-12-01' AND '2566-12-31'";
$result_m12 = mysqli_query($conn,$sql_m12);
$row_m12 = mysqli_fetch_assoc($result_m12);

//<!-----------------------------------------------------12----------------------------------------------------->
?>
<!--chart data-->

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
    <link href="./css/highchart.css"rel="stylesheet">
    <style>
        .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

    </style>
    <!--CSS end-->
</head>
<body>

<!--Content Start-->
    <div class="container-fluid position-relative ">
        <div class="row" >
        <!--navber-->
            <nav class="navbar navbar-expand bg-secondary navbar-dark px-4 py-0">
                <form class=" ">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>QC ReturnOrder </h3>
                </a>
                </form>
                <div class="navbar-nav align-items-center ms-auto text-primary">
                
                <a href="index.php" class="nav-item nav-link active text-primary"><i class="fa fa-tachometer-alt me-2 text-primary"></i>Dashboard</a>
                <a href="report.php" class="nav-item nav-link"><i class="fa fa-th me-2 "></i>Add</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="text-primary nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="./js/T-11.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['status_login']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0 text-primary">
                            <a href="logout.php" class="dropdown-item text-primary">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
        <!--navbar end-->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                   
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-primary">ยอดเงินรวมทั้งหมด</p>
                                <h6 class="mb-0"><?php echo $sum ;?>    :   บาท</h6>
                                <hr>
                                <a href="index2.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-primary">ลูกค้าที่คืนสินค้ามูลค่าสูงที่สุด</p>
                                <h6 class="mb-0" style="font-size:12px"><?php echo $sum2 ?></h6>
                                <hr>
                                <a href="index3.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-primary">สินค้าที่คืนมากที่สุด</p>
                                <h6 class="mb-0 "><?php echo $sum3 ?></h6>
                                <hr>
                                <a href="index4.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-primary">ปัญหาที่พบมากที่สุด</p>
                                <h6 class="mb-0"><?php echo $sum1 ;?></h6>
                                <hr>
                                <a href="index1.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!--Highchart-->
        <div class="row">
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>
            <figure class="highcharts-figure bg-secondary">
                <p class="highcharts-description"></p>
                    <div id="container" class="col-md-12 bg-secondary"></div>
                <p class="highcharts-description"></p>
            </figure>
            </div>
            <div class="row">
                <div class="col-5"></div>
            <div class="col-1">
                <a type="button" href="./index2565.php" class="btn btn-primary">2565</a>
            </div>
            <div class="col-1">
                <a type="button" href="./index.php" class="btn btn-primary">2566</a>
            </div>
                <div class="col-5"></div>
            </div>
        <!--Highchart-->
       

    <!--Content end-->
    
     <!--Footer-->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">CJL QC Information</a>, All Right Reserved. </div>                       
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
     <!--Footer-->

     <!--Back to top-->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>
     <!--Back to top-->
     
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
            <script>
                // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'center',
        text: 'ยอดเงินรวมทั้งหมด'
    },
    subtitle: {
        align: 'center',
        text: 'Source: <a href="" target="_blank">ERP CRO</a>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'จำนวน'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: ''
            }
        }
    },

    tooltip: {
        headerFormat: '',
        pointFormat: ' <b>{point.y:.2f}</b>: บาท<br/>'
    },

    series: [
        {
            name: " ",
            colorByPoint: true,
            data: [
                {
                    name: "ม.ค.",
                    y: <?php echo $row_m1['amount'] ?>,
                    
                },
                {
                    name: "ก.พ.",
                    y: <?php echo $row_m2['amount'] ?>,
                    
                },
                {
                    name: "มี.ค.",
                    y: <?php echo $row_m3['amount'] ?>,
                    
                },
                {
                    name: "เม.ย.",
                    y: <?php echo $row_m4['amount'] ?>,
                    
                },
                {
                    name: "พ.ค.",
                    y: <?php echo $row_m5['amount'] ?>,
                   
                },
                {
                    name: "มิ.ย.",
                    y:<?php echo $row_m6['amount'] ?>,
                    
                },
                {
                    name: "ก.ค.",
                    y: <?php echo $row_m7['amount'] ?>,
                    
                },
                {
                    name: "ส.ค",
                    y: <?php echo $row_m8['amount'] ?>,
                    
                },
                {
                    name: "ก.ย",
                    y: <?php echo $row_m9['amount'] ?>,
                    
                },
                {
                    name: "ต.ค",
                    y: <?php echo $row_m10['amount'] ?>,
                    
                },
                {
                    name: "พ.ย.",
                    y: <?php echo $row_m11['amount'] ?>,
                   
                },
                {
                    name: "ธ.ค.",
                    y:<?php echo $row_m12['amount'] ?>,
                    
                }
            ]
        }
    ]
            });

            </script>
    <!--script-->

</body>
</html>
<?php }
?>
