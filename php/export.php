<!--หน้าคำสั่งให้ Export ตารางจากเว็ปไปเป็น Excel-->
<?php session_start();?>
<?php include('./connect.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CJL QC ReturnOrder</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!--CSS-->
    <link href="../js/T-11.png" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!--CSS End-->
</head>

<body>
					<?php 
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
							header("Content-Type: application/xls"); //กำหนดตัว App ที่ต้องการ   
	header("Content-Disposition: attachment; filename=CRO-ReturnOrder.xls");  //กำหนดชื่อของไฟล์ Excel
	header("Pragma: no-cache"); //กำหนดให้ไม่มีแคช
	header("Expires: 0"); //ตั้งค่าให้ไม่มีวันหมดอายุ
	$output = ""; //หัวข้อตาราง
 
	$output .=" 
		<table class='table-bordered'>
			<thead>
				<tr>
                <th>เลขที่ CRO</th>
				<th>วันที่เอกสาร</th>
                <th>รหัสลูกค้า</th>
                <th>ลูกค้า</th>
                <TH>รหัสสินค้า</TH>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคา/หน่วย</th>
                <th>ชื่อเซลล์</th>
                <th>ขนส่ง</th>
                <th>หมายเหตุ</th>
				<th>สาเหตุ</th>
				</tr>
			<tbody>
			
	";
	$query = $conn->query("SELECT *
    FROM  tbcro INNER JOIN tbproadd
       ON  tbcro.croid = tbproadd.croid "); //ประกาศ query เชื่อม 2 ตารางเข้าด้วยกัน
	while($fetch = $query->fetch_array()){ //While Loop เพื่อ Fetch ข้อมูลลงตาราง 

	$output .= "
				<table class='table-bordered'>
				<tr>
					<td>".$fetch['croid']."</td>
					<td>".$fetch['datecro']."</td>
                    <td>".$fetch['membercode']."</td>
					<td>".$fetch['customername']."</td>
					<td>".$fetch['barcode']."</td>
					<td>".$fetch['quantity']."</td>
					<td>".$fetch['unit']."</td>
                    <td>".$fetch['price']."</td>
                    <td>".$fetch['sales']."</td>
                    <td>".$fetch['shipping']."</td>
                    <td>".$fetch['remark']."</td>
					<td>".$fetch['problem']."</td>

				</tr><hr>
				</table>
	";
	}
	$output .="

			</tbody>
 
		</table>
	";
 
	echo $output;
 
 

                        }else if($date1 != '' && $date2 != ''){
	header("Content-Type: application/xls"); //กำหนดตัว App ที่ต้องการ   
	header("Content-Disposition: attachment; filename=CRO-ReturnOrder.xls");  //กำหนดชื่อของไฟล์ Excel
	header("Pragma: no-cache"); //กำหนดให้ไม่มีแคช
	header("Expires: 0"); //ตั้งค่าให้ไม่มีวันหมดอายุ
	$output = ""; //หัวข้อตาราง
 
	$output .=" 
		<table class='table-bordered'>
			<thead>
				<tr>
                <th>เลขที่ CRO</th>
				<th>วันที่เอกสาร</th>
                <th>รหัสลูกค้า</th>
                <th>ลูกค้า</th>
                <TH>รหัสสินค้า</TH>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคา/หน่วย</th>
                <th>ชื่อเซลล์</th>
                <th>ขนส่ง</th>
                <th>หมายเหตุ</th>
				<th>สาเหตุ</th>
				</tr>
			<tbody>
			
	";
	$query = $conn->query("SELECT *
    FROM  tbcro INNER JOIN tbproadd
       ON  tbcro.croid = tbproadd.croid WHERE datecro BETWEEN '$a' and '$b' ORDER BY `tbcro`.`croid` ASC"); //ประกาศ query เชื่อม 2 ตารางเข้าด้วยกัน
	while($fetch = $query->fetch_array()){ //While Loop เพื่อ Fetch ข้อมูลลงตาราง 

	$output .= "
				<table class='table-bordered'>
				<tr>
					<td>".$fetch['croid']."</td>
					<td>".$fetch['datecro']."</td>
                    <td>".$fetch['membercode']."</td>
					<td>".$fetch['customername']."</td>
					<td>".$fetch['barcode']."</td>
					<td>".$fetch['quantity']."</td>
					<td>".$fetch['unit']."</td>
                    <td>".$fetch['price']."</td>
                    <td>".$fetch['sales']."</td>
                    <td>".$fetch['shipping']."</td>
                    <td>".$fetch['remark']."</td>
					<td>".$fetch['problem']."</td>

				</tr><hr>
				</table>
	";
	}
	$output .="

			</tbody>
 
		</table>
	";
 
	echo $output;
 
 

                        }
                    }
					?>
					<div class="container-fluid position-relative">
        <div class="row">
            <!--navbar start-->
            <nav class="navbar navbar-expand bg-secondary navbar-dark px-4 py-0">
                <form class=" ">
                    <a href="../index.php" class="navbar-brand mx-4 mb-3">
                        <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>QC ReturnOrder</h3>
                    </a>
                </form>
                <div class="navbar-nav align-items-center ms-auto text-primary">
                    <a href="../index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2 "></i>Dashboard</a>
                    <a href="../report.php" class="nav-item nav-link text-primary"><i class="fa fa-th me-2 text-primary "></i>Add</a>
                        <a href="../logout.php">
                            <img class="rounded-circle me-lg-2" src="../js/T-11.png" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['status_login']; ?></span>
                        </a>
                </div>
            </nav>
            <!--navbar end-->   

			<div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <h1 class="text-success">Export To Excel</h1>
					<form action="export.php" method="post" enctype="multipart/form-data">
                    	<div class="row mb-1">
                            <div class="col-md-12 text-center">
                                <h4 class="text-light mb-1"><u>ตั้งแต่วันที่</u></h4>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <input type="date" name="date1" id="date1"  value="<?php echo $date1?>" >
                                </div>
                            </div>
                            ถึง
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
                                <button type="submit" name="search" class="btn btn-success ">Export เลย</button>
                            </div>
                            </div>
                    </form>
				</div>
			</div>
		</div>
					</div>
 <!--Script-->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
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