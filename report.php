<!--Call Server-->
<?php session_start();?>
<?php include('./php/connect.php');?>
<!--Call Server-->

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" media="all" type="text/css" href="jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />

    <script type="text/javascript" src="jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>

    <script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="jquery-ui-sliderAccess.js"></script>
    <!--CSS End-->
</head>

<body>
    <div class="container-fluid position-relative ">
        <div class="row">
            <!--navbar start-->
            <nav class="navbar navbar-expand bg-secondary navbar-dark px-4 py-0">
                <form class=" ">
                    <a href="index.php" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>QC ReturnOrder</h3>
                    </a>
                </form>
                <div class="navbar-nav align-items-center ms-auto text-primary">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2 "></i>Dashboard</a>
                    <a href="report.php" class="nav-item nav-link text-primary"><i class="fa fa-th me-2 text-primary "></i>Add</a>
                        <a href="logout.php">
                            <img class="rounded-circle me-lg-2" src="./js/T-11.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['status_login']; ?></span>
                        </a>
                </div>
            </nav>
            <!--navbar end-->   


            <?php
                     $sql = "SELECT *FROM  tbcro "; 
                     $result = mysqli_query($conn, $sql);
                    if (isset($_POST['search'])) {
                        $date1 = $_POST['date1'];
                        $date3=date_create("$date1");
                        $y = date_format($date3,"Y")+543;
                        $date3 = date_format($date3,"m-d");
                        $a = $y."-".$date3;
                        $date2 = $_POST['date2'];
                        $date4=date_create("$date2");
                        $x = date_format($date4,"Y")+543;
                        $date4 = date_format($date4,"m-d");
                        $b = $x."-".$date4;
                        if($date1 == '' && $date2 == ''){
                            $sql = "SELECT *FROM  tbcro "; 
                            $result = mysqli_query($conn, $sql);
                        }else if($date1 != '' && $date2 != ''){
                            $sql = "SELECT *FROM  tbcro WHERE datecro BETWEEN '$a' and '$b' ORDER BY datecro ASC"; 
                            $result = mysqli_query($conn, $sql);
                        }
                    }
                    ?>


            <!--Content Start-->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h1 class="text-primary">CRO : ReturnOrder</h1>

                    <form action="report.php" method="post" enctype="multipart/form-data">
                    <div class="row mb-1">
                            <div class="col-md-12 text-center">
                                <h4 class="text-light mb-1"><u>ค้นหาเอกสาร</u></h4>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <input type="date" name="date1" id="date1"  value="<?php echo $date1?>" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <input type="date" name="date2" id="date2"  value="<?php echo $date2?>">
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-12"><br></div>
                            <div class="col-md-5"></div>
                            <div class="col-md-2">
                            <div class="col-md-12">
                                <button type="submit" name="search" class="btn btn-warning ">ค้นหา</button>
                            </div>
                            </div>
                    </form>

                        <div class="row justify-content-center">
                        <div>
                            <div class="col-2">
                                <a href="form-create.php" class="btn btn-primary" style="float:left;">เพิ่มรายการ</a>
                            </div>
                            <!--Export Excel-->
                            <a class="btn btn-outline-success" href="./php/export.php" style="float:right;">Save as Excel</a>
                            <!--Export Excel-->
                        </div>
                        <div>
                            
                            <!--Datatable-->
                            <div class="table-bordered">
                                <?php
                                        if (mysqli_num_rows($result) > 0) : ?>
                                    <table id="myTABLE" class="table table-responsive " width="100%">
                                        <thead>
                                            <tr class=" text-primary bg-dark">
                                                <th width="5%">#</th>
                                                <th width="10%">เลขที่ CRO</th>
                                                <th width="7%">วันที่</th>
                                                <th width="25%">ลูกค้า</th>
                                                <th width="10%">รหัสสินค้า</th>
                                                <th width="5%">จำนวน</th>
                                                <th width="5%">หน่วย</th>
                                                <th width="8%">ราคา/หน่วย</th>
                                                <th width="10%">ชื่อเซลล์</th>
                                                <th width="10%">หมายเหตุ</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($result as $row) { ?>
                                                <tr class=" text-white">
                                                    <td> <?php echo $i++ ?> </td>
                                                    <td> <?php echo $row['croid'] ?> </td>
                                                    <td> <?php echo $row['datecro'] ?> </td>
                                                    <td> <?php echo $row['customername'] ?> </td>
                                                    <td>
                                                        <table class="">
                                                            <?php
                                                            $aa = $row['croid'];
                                                            $sql2 = "SELECT * FROM `tbproadd` WHERE croid = '$aa'";
                                                            $result2 = mysqli_query($conn, $sql2);
                                                            if (mysqli_num_rows($result2) > 0) {
                                                                foreach ($result2 as $row2) {
                                                            ?>
                                                                    <tr class=" text-white">
                                                                        <td class=""><?php echo $row2['barcode'] ?></td>
                                                                    </tr> <?php }
                                                                    } ?>
                                                        </table>
                                                        </td>
                                                    <td>
                                                        <table class="">
                                                            <?php
                                                            if (mysqli_num_rows($result2) > 0) {
                                                                foreach ($result2 as $row2) {
                                                            ?>
                                                                    <tr class=" text-white">
                                                                        <td><?php echo $row2['quantity'] ?></td>
                                                                    </tr> <?php }
                                                                    } ?>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="">
                                                            <?php
                                                            if (mysqli_num_rows($result2) > 0) {
                                                                foreach ($result2 as $row2) {
                                                            ?>
                                                                    <tr class=" text-white">
                                                                        <td><?php echo $row2['unit'] ?></td>
                                                                    </tr> <?php }
                                                                    } ?>
                                                        </table>
                                                    </td>
                                                   
                                                    <td><table class="">
                                                            <?php
                                                            if (mysqli_num_rows($result2) > 0) {
                                                                foreach ($result2 as $row2) {
                                                            ?>
                                                                    <tr class=" text-white">
                                                                        <td><?php echo $row2['price'] ?>    :   บาท</td>
                                                                    </tr> <?php }
                                                                    } ?>
                                                        </table></td>
                                                    <td> <?php echo $row['sales'] ?> </td>
                                                    <td>
                                                        <table>
                                                            <?php
                                                            if (mysqli_num_rows($result2) > 0) {
                                                                foreach ($result2 as $row2) {
                                                            ?>
                                                                    <tr class=" text-white">
                                                                        <td><?php echo $row2['remark'] ?></td>
                                                                    </tr> <?php }
                                                                    } ?>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group text-white">
                                                            <a class="btn btn-PRIMARY" name="modal" data-bs-toggle="modal" data-bs-target="#my-modal<?php echo $row2['id'] ?>">VIEW </a>
                                                            <a href="form-update.php?croid=<?php echo $row2['croid'] ?>" class="btn btn-warning">EDIT </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- Modal -->
                                                <div class="modal fade" id="my-modal<?php echo $row2['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-dark" id="exampleModalLabel">รายละเอียด</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>เลขที่ CRO: <?php echo $row['croid'] ?></p>
                                                                <p>วันที่เอกสาร: <?php echo $row['datecro'] ?></p>
                                                                <p>รหัสลูกค้า: <?php echo $row['membercode'] ?></p>
                                                                <p>ชื่อลูกค้า: <?php echo $row['customername'] ?></p>
                                                                <?php
                                                                    if (mysqli_num_rows($result2) > 0) {
                                                                    foreach ($result2 as $row2) {?>
                                                                        <p>รหัสสินค้า: <?php echo $row2['barcode'] ?>      จำนวน  :  <?php echo $row2['quantity'] ?> <?php echo $row2['unit'] ?></p>
                                                                      <?php
                                                                    }
                                                                    } ?>
                                                                <p>ราคาสุทธิ: <?php echo number_format($row['amount'], 0) ?> บาท</p>
                                                                <p>ชื่อเซลล์: <?php echo $row['sales'] ?> </p>
                                                                <p>ประเภทการขนส่ง: <?php echo $row['shipping'] ?> </p>
                                                                <p>สาเหตุการคืนของ: <?php echo $row2['problem'] ?> </p>
                                                                <hr>
                                                                <p>เพิ่มโดย: <?php echo $row['status_login'] ?> </p>
                                                                <p>วันที่นำเข้าระบบ: <?php echo dateThai($row['created_at']) ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Modal end-->

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <!--content end-->
                                <?php
                                else :
                                    echo "<p class='mt-5'>ไม่มีข้อมูลในฐานข้อมูล</p>";
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <?php mysqli_close($conn) ?>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTABLE').DataTable();
        });
    </script>
    <script src="js/main.js"></script>
    </div>
    <!--Datatable end-->

    <!--footer-->
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
    <!--footer-->

    <!--back to top-->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    <!--back to top-->

    <!--Script-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/excellentexport@3.7.0/dist/excellentexport.min.js"></script>
    <!--Script-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <!--<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>-->

</body>

</html>