<?php session_start();?>
<?php include('./php/connect.php');?>
<!-----------------------------------------------------1----------------------------------------------------->
<?php 
    $res = mysqli_query($conn,'SELECT ROUND(sum(price),2) FROM tbproadd');
    $row = mysqli_fetch_row($res);
    $sum = $row[0];
?>
<!-----------------------------------------------------2----------------------------------------------------->
<?php 
    $res1 = mysqli_query($conn,'SELECT remark, SUM( quantity )FROM `tbproadd`GROUP BY remark ORDER BY SUM( quantity ) DESC LIMIT 1;');
    $row1 = mysqli_fetch_row($res1);
    $sum1 = $row1[0];
?>
<!-----------------------------------------------------3----------------------------------------------------->
<?php 
    $res2 = mysqli_query($conn,'SELECT customername, SUM( amount )FROM `tbcro` GROUP BY customername ORDER BY SUM( amount ) DESC LIMIT 1;');
    $row2 = mysqli_fetch_row($res2);
    $sum2 = $row2[0];
?>
<!-----------------------------------------------------4----------------------------------------------------->
<?php 
    $res3 = mysqli_query($conn,'SELECT barcode, SUM(quantity) FROM `tbproadd`GROUP BY barcode ORDER BY `SUM(quantity)` DESC LIMIT 1;');
    $row3 = mysqli_fetch_row($res3);
    $sum3 = $row3[0];
?>
<!-----------------------------------------------------5----------------------------------------------------->

<!--chart data-->
<!-----------------------------------------------------0----------------------------------------------------->
<?php
$sql_re1 = "SELECT barcode, SUM( quantity )FROM `tbproadd` GROUP BY barcode ORDER BY SUM( quantity ) DESC LIMIT 5 OFFSET 0;";
$result_re1 = mysqli_query($conn, $sql_re1);
$row_re1 = mysqli_fetch_assoc($result_re1);
?>
<!-----------------------------------------------------1----------------------------------------------------->
<?php
$sql_re2 = "SELECT barcode, SUM( quantity )FROM `tbproadd` GROUP BY barcode ORDER BY SUM( quantity ) DESC LIMIT 5 OFFSET 1;";
$result_re2 = mysqli_query($conn, $sql_re2);
$row_re2 = mysqli_fetch_assoc($result_re2);
?>
<!-----------------------------------------------------2----------------------------------------------------->
<?php
$sql_re3 = "SELECT barcode, SUM( quantity )FROM `tbproadd` GROUP BY barcode ORDER BY SUM( quantity ) DESC LIMIT 5 OFFSET 2;";
$result_re3 = mysqli_query($conn, $sql_re3);
$row_re3 = mysqli_fetch_assoc($result_re3);
?>
<!-----------------------------------------------------3----------------------------------------------------->
<?php
$sql_re4 = "SELECT barcode, SUM( quantity )FROM `tbproadd` GROUP BY barcode ORDER BY SUM( quantity ) DESC LIMIT 5 OFFSET 3;";
$result_re4 = mysqli_query($conn, $sql_re4);
$row_re4 = mysqli_fetch_assoc($result_re4);
?>
<!-----------------------------------------------------4----------------------------------------------------->
<?php
$sql_re5 = "SELECT barcode, SUM( quantity )FROM `tbproadd` GROUP BY barcode ORDER BY SUM( quantity ) DESC LIMIT 5 OFFSET 4;";
$result_re5 = mysqli_query($conn, $sql_re5);
$row_re5 = mysqli_fetch_assoc($result_re5);
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
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/modules/data.js"></script>
            <script src="https://code.highcharts.com/modules/drilldown.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script src="https://code.highcharts.com/modules/export-data.js"></script>
            <script src="https://code.highcharts.com/modules/accessibility.js"></script>

            <figure class="highcharts-figure bg-secondary">
                <p class="highcharts-description"></p>
                    <div id="container" class="col-md-12 bg-secondary"></div>
                <p class="highcharts-description"></p>
            </figure>
            
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
        align: 'left',
        text: 'สินค้าที่คืนมากที่สุด'
    },
    subtitle: {
        align: 'left',
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
            text: 'ชิ้น'
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
        pointFormat: ' <b>{point.y}</b> ชิ้น<br/>'
    },

    series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: [
                {
                    name: '<?php echo $row_re1['barcode'] ;?>',
                    y: <?php echo $row_re1['SUM( quantity )'] ;?>,
                    
                },
                {
                    name: '<?php echo $row_re2['barcode'] ;?>',
                    y: <?php echo $row_re2['SUM( quantity )'] ;?>,
                    
                },
                {
                    name: '<?php echo $row_re3['barcode'] ;?>',
                    y: <?php echo $row_re3['SUM( quantity )'] ;?>,
                    
                },
                {
                    name: '<?php echo $row_re4['barcode'] ;?>',
                    y: <?php echo $row_re4['SUM( quantity )'] ;?>,
                    
                },
                {
                    name: '<?php echo $row_re5['barcode'] ;?>',
                    y: <?php echo $row_re5['SUM( quantity )'] ;?>,
                }
            ]
        }
    ]
            });

            </script>
            
</body>
</html>