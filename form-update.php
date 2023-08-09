<?php session_start();?>
<?php 
    require_once('php/connect.php');
    if(!isset($_GET['croid'])){
        header("location: ./");
        exit();
    }
    $ss = $_GET['croid'];
    $sql = "SELECT * FROM  tbcro WHERE croid = '$ss'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขรายการ </title>
    <!-- Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
        .flex-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #000000;
        }
    </style>
</head>
<body>
<div class="flex-container bg-dark">
    <div class="container bg-secondary">
        <div class="shadow rounded p-5 bg-secondary h-100">
            <div class="row justify-content-center bg-secondary">
                <div class="col-md-10 bg-secondary">
                    <h1 class="mb-5 text-primary"> แก้ไขรายการ </h1>
                    <hr>
                    <form class="row gy-4 bg-secondary" action="php/update.php" method="POST">
                        <div class="col-md-10">
                            <label for="croid" class="form-label text-white">เลขที่CRO</label> *ไม่สามารถแก้ไขได้
                            <input type="text" class="form-control text-dark" id="croid" name="croid" value="<?php echo $row['croid'] ?>" readonly>
                        </div>
                        <div class="col-md-2">
                                <label for="datecro" class="form-label text-white">วันที่เอกสาร</label>
                                <input type="date" name="datecro" id="datecro" class="form-control text-white" value="<?php echo $row['datecro'] ?>">
                            </div>
                        <div class="col-md-12">
                            <label for="membercode" class="form-label text-white">รหัสลูกค้า</label>
                            <input type="text" class="form-control text-white" id="membercode" name="membercode" value="<?php echo $row['membercode'] ?>"required>
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label text-white">ลูกค้า</label>
                            <input type="text" class="form-control text-white" id="customername" name="customername" value="<?php echo $row['customername'] ?>"required>
                        </div>
                        <div class="col-md-6">
                            <label for="salename" class="form-label text-white">ชื่อเซลล์</label>
                            <input type="text" class="form-control text-white" id="sales" name="sales" value="<?php echo $row['sales'] ?>"required>
                        </div>
                        <div class="col-md-12">
                                <label for="shipping" class="form-label text-white">ประเภทการขนส่ง</label>
                                <input list="shipping" id="ship" name="ship" class="form-control text-white" value="<?php echo $row['shipping'] ?>"required>
                            </div>
                        <div class="input field">
                                    <table class="responsive" id="dynamic_field"> 
                                        <th class="text-white">รหัสสินค้า</th>
                                        <th class="text-white">จำนวน</th>
                                        <th class="text-white">หน่วย</th>
                                        <th class="text-white">ราคา/หน่วย</th>
                                        <th class="text-white">หมายเหตุ</th>
                                        <th class="text-white">สาเหตุการคืนของ</th>
                                        <tr>
                        <?php
                        $aa = $row['croid'];
                        $sql2 = "SELECT * FROM `tbproadd` WHERE croid = '$aa'";
                        $result2 = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($result2) >= 1) {
                            foreach ($result2 as $row2) {?>
                            <tr>
                                    <input type="hidden" class="form-control text-dark" id="id" name="id[]" value="<?php echo $row2['id']?>" readonly>
                             
                                <td>
                                    <input type="text" class="form-control text-white" id="barcode" name="barcode[]" value="<?php echo $row2['barcode']?>" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-white" id="quantity" name="quantity[]" value="<?php echo $row2['quantity']?>" required>
                                </td>
                                <td>
                                    <input list="text" class="form-control text-dark" id="unit" name="unit[]" value="<?php echo $row2['unit']?>" readonly>
                                </td>
                                <td>
                                    <input list="text" class="form-control text-white" id="price" name="price[]" onkeyup="findTotal()" class="form-control price" value="<?php echo $row2['price']?>" required>
                                </td>
                                <td>
                                    <input list="remarks" id="remark" name="remark[]" class="form-control text-white" value="<?php echo $row2['remark']?>" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control text-white" id="problem" name="problem[]"  value="<?php echo $row2['problem']?>" required>
                                </td>
                            </tr>
                            <?php
                           }
                        } ?>
                                        </tr>
                                    </table>
                                    <div class="col-lg-12 col-2 text-center">
                                    <input type="button" id="createRows" class="btn btn-dark "value="+"> <!--Addmore button--> 
                                    </div>
                                </div>
                        <div class="col-md-6">
                            <label for="amount" class="form-label text-white">ราคาสุทธิ</label>
                            <input type="text" class="form-control text-white" id="amount" name="amount" value="<?php echo $row['amount'] ?>"required>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary d-block mx-auto">บันทึกการเปลี่ยนแปลง</button>
                        </div>
                    </form>
                    <a href="./report.php">ย้อนกลับ</a>
                </div>  
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <!--Dropdown Remark-->
    <datalist id="remarks">
  <option value="ความผิดพลาดจากโรงงาน"></option>
  <option value="ความผิดพลาดจากบริษัท"></option>
  <option value="ความผิดพลาดจากเซลล์"></option>
  <option value="สินค้าตัวแทนจำหน่าย"></option>
  <option value="ไม่ตรงความต้องการของลูกค้า"></option>
  <option value="อื่นๆ"></option>
</datalist>
  <!--Dropdown Remark End-->

  <!--Dropdown unit-->
  <datalist id="units">
  <option value="ตัว"></option>
  <option value="คู่"></option>
  <option value="กล่อง"></option>
  <option value="ชิ้น"></option>
</datalist>
  <!--Dropdown unit End-->

   <!--Dropdown Remark-->
   <datalist id="shipping">
  <option value="เซลล์นำกลับเข้าบริษัท"></option>
  <option value="เซลล์นำส่งโดยผ่านขนส่งเอกชน"></option>
  <option value="สินค้านำกลับมาโดยขนส่งเอกชน"></option>
  <option value="สินค้านำกลับมาโดยขนส่งบริษัท"></option>
</datalist>
  <!--Dropdown Remark End-->

  <script type="text/javascript" src="jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="jquery-ui.min.js"></script>
    <script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="jquery-ui-sliderAccess.js"></script>
    <script type="text/javascript">

        $(function(){
            $("#datecro").datepicker({
                dateFormat: 'dd-M-yy'
            });
        });

    </script>

    <!--Script Function Sum Amount-->
    <script>
    function findTotal(){
    var arr = document.getElementsByClassName('form-control price');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('amount').value = tot;
    }
    </script>
    <!--Script Function Sum Amount-->
        <!--addmore button-->
<script type="text/javascript">
$(document).ready(function(){
	var rows = 1;
	$("#createRows").click(function(){
						var tr = "<tr>";
						tr = tr + "<td><input style='text-transform:uppercase' onblur='check();' type='text' name='barcode"+rows+"' id='barcode"+rows+"' class='form-control' placeholder='รหัสสินค้า' onchange='eng_only()' required></td>";
						tr = tr + "<td><input type='text' name='quantity"+rows+"' id='quantity"+rows+"' class='form-control' placeholder='จำนวน' required></td>";
						tr = tr + "<td><input list='text' name='unit"+rows+"' id='unit"+rows+"' class='form-control' value='รายการ' readonly></td>";
                        tr = tr + "<td><input type='text' name='price"+rows+"' id='price"+rows+"' onkeyup='findTotal()' class='form-control price' placeholder='ราคา/หน่วย' required></td>";
						tr = tr + "<td><input list='remarks' id='remark"+rows+"' name='remark"+rows+"' class='form-control' placeholder='หมายเหตุ'/ required></td>";
                        tr = tr + "<td><input type='text' name='problem"+rows+"' id='problem"+rows+"' class='form-control' placeholder='สาเหตุ' required></td>";
                        tr = tr + "</tr>";
						$('#dynamic_field > tbody:last').append(tr);
					
						$('#hdnCount').val(rows);
						rows = rows + 1;
		});
		$("#deleteRows").click(function(){
				if ($("#dynamic_field tr").length != 1) {
					 $("#dynamic_field tr:last").remove();
				}
		});

		$("#clearRows").click(function(){
				rows = 1;
				$('#hdnCount').val(rows);1
				$('#myTable > tbody:last').empty(); // remove all
		});

	});
</script>
    <!--addmore button end-->
</body>
</html>