<!--connect db-->
<?php session_start();?>
<?php
 include('php/connect.php')
?>
<!--connect db End-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายการสินค้า</title>
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
    <link rel="stylesheet" media="all" type="text/css" href="jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />
    <style>
        .flex-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #000000;
        }
    </style>
    <!--CSS end-->
</head>
<body>
    <!--content start-->
    <div class="flex-container bg-dark">
        <div class="container bg-secondary">
            <div class="shadow rounded p-5 bg-secondary h-100">
                <div class="row justify-content-center bg-secondary">
                    <div class="col-md-10 bg-secondary">
                        <h1 class="mb-5 text-primary"> เพิ่มรายการสินค้า </h1>
                        <hr>
                        <!--เปิดการใช้งาน Form-->
                        <form class="row gy-4" action="php/create.php" method="POST" >   <!--ประกาศให้ Form นี้ทำงานจาก create.php-->
                            <div class="col-md-10">
                                <label for="croid" class="form-label text-white">เลขที่CRO</label>
                                <input style="text-transform:uppercase" type="text" class="form-control " id="croid" name="croid" placeholder="เลขที่CRO" onchange="eng_only()" required>
                            </div>
                            <div class="col-md-2">
                                <label for="datecro" class="form-label text-white">วันที่เอกสาร</label>
                                <input type="date" name="datecro" id="datecro" class="form-control" value="">
                            </div>
                        <!--Work with select.php-->
                            <div class="col-md-6">
                                <label for="membercode" class="form-label text-white">รหัสลูกค้า</label>
                                <input style="text-transform:uppercase" type="text" class="form-control " id="membercode" name="membercode" placeholder="รหัสลูกค้า" onchange="eng_only()" required>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="submit" name="search" class="btn btn-success ">Search</button>
                            </div>
                            <div class="row" id="cusdetail">
                            <!--เปิด div ไว้เพื่อให้หน้า Select.php ทำงาน-->
                            </div>
                        <!--End process-->
                        <div class="col-md-12">
                                <label for="shipping" class="form-label text-white">ประเภทการขนส่ง</label>
                                <input list="shipping" id="ship" name="ship" class="form-control" placeholder="ประเภทการขนส่ง"required>
                            </div>
                            <hr>

                            <!--dynamic input field start-->
                              <div class="input field">
                                    <table class="responsive" id="dynamic_field"> 
                                        <th class="text-white">รหัสสินค้า</th>
                                        <th class="text-white">จำนวน</th>
                                        <th class="text-white">หน่วย</th>
                                        <th class="text-white">ราคา</th>
                                        <th class="text-white">หมายเหตุ</th>
                                        <th class="text-white">สาเหตุการคืนของ</th>
                                        <tr>
                                            <td>
                                                <input style="text-transform:uppercase" type="text" class="form-control" id="barcode" name="barcode" onblur="check();" placeholder="รหัสสินค้า" onchange="eng_only()" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="quantity" name="quantity" placeholder="จำนวน" required>
                                            </td>
                                            <td>
                                                <input list="text" class="form-control" id="unit" name="unit" value="รายการ" readonly>
                                            </td>
                                            <td>
                                                <input list="text" class="form-control price" id="price" name="price" onkeyup="findTotal()" placeholder="ราคา/หน่วย"required>
                                            </td>
                                            <td>
                                                <input list="remarks" id="remark" name="remark" class="form-control" placeholder="หมายเหตุ"required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="problem" name="problem" placeholder="สาเหตุ" required>
                                            </td>
                                            <td>
                                                <input type='button' id='deleteRows' class='btn btn-danger 'value='x'>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="col-lg-12 col-2 text-center">
                                    <input type="button" id="createRows" class="btn btn-dark "value="+"> <!--Addmore button--> 
                                    </div>
                                </div>
                        <!--dynamic input field end-->

                            <div class="col-md-6">
                                <label for="amount" class="form-label text-white">จำนวนเงินสุทธิ</label>
                                <input type="text" class="form-control" id="amount" name="amount" placeholder="จำนวนเงินสุทธิ" onkeypress='return keyEnter(event)' required>
                            </div>
                            <br>

                            <div class="col-12">
                            <input type="hidden" id="hdnCount" name="hdnCount">
                                <button type="submit" name="submit" class="btn btn-primary" onkeypress='return keyEnter(event)'>บันทึกการเปลี่ยนแปลง</button>
                            </div>
                        </form> 
                        <!--Form End-->
                        <br>
                        
                        <a href="./report.php">ย้อนกลับ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--content end-->

    <!--script-->
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!--script-->

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

    <!--Auto Fetch Cusname-->
<script>
	$('[name="search"]').click(function() {
            var membercode = $ ("#membercode").val();
            
            console.log(membercode);
			
            $.ajax({
				type: "POST",
				url: "./php/select.php",
				data: {
					membercode: membercode
				},
				success: function(data) {
					$("#cusdetail").html(data);
				}
			});
		});
  </script>
  <!--Auto Fetch Cusname End-->
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

  <!--Dropdown Remark-->
  <datalist id="shipping">
  <option value="เซลล์นำกลับเข้าบริษัท"></option>
  <option value="เซลล์นำส่งโดยผ่านขนส่งเอกชน"></option>
  <option value="สินค้านำกลับมาโดยขนส่งเอกชน"></option>
  <option value="สินค้านำกลับมาโดยขนส่งบริษัท"></option>
</datalist>
  <!--Dropdown Remark End-->

  <script type="text/javascript">
      function eng_only() {

        var temp = $("#croid").val(); //เก็บข้อความที่พิมพ์ใน text box 

        temp = temp.toUpperCase(); //เปลี่ยนให้ทุกตัวอักษรเป็น ตัวพิมพ์ใหญ่

        //วน loop แต่ละตัวอักษร เพื่อดูว่าแต่ละตัวอักษรเป็นภาษาไทย หรือภาษาอังกฤษ
        for (i = 0; i < temp.length; i++) {

          if ((temp[i] == "A") || (temp[i] == "B") || (temp[i] == "C") || (temp[i] == "D") || (temp[i] == "E") || (temp[i] == "F") || (temp[i] == "G") ||
            (temp[i] == "H") || (temp[i] == "I") || (temp[i] == "J") || (temp[i] == "K") || (temp[i] == "L") || (temp[i] == "M") || (temp[i] == "N") ||
            (temp[i] == "O") || (temp[i] == "P") || (temp[i] == "Q") || (temp[i] == "R") || (temp[i] == "S") || (temp[i] == "T") || (temp[i] == "U") ||
            (temp[i] == "V") || (temp[i] == "W") || (temp[i] == "X") || (temp[i] == "Y") || (temp[i] == "Z") || (temp[i] == "0") || (temp[i] == "1") ||
            (temp[i] == "2") || (temp[i] == "3") || (temp[i] == "4") || (temp[i] == "5") || (temp[i] == "6") || (temp[i] == "7") || (temp[i] == "8") ||
            (temp[i] == "9")) {

          } else {
            $("#croid").val($("#croid").val().replace(temp[i], "")); //ลบตัวอักษรที่ไม่ใช่ภาษาอังกฤษออก
          }

        }

      }
    </script>

    <!--<script>
	function check()
	{
		var elem = document.getElementById("#barcode").value;
		if(!elem.match(/^([A-Z0-9])+$/i))
		{
			alert("กรอกได้เฉพาะตัวเลขและตัวอักษรภาษาอังกฤษเท่านั้น");
			document.getElementById("#barcode").value = "";
		}
	}
</script>-->

<script>
function keyEnter(even) {
 
    if( even.keyCode == 13 ) {
     
        return false;
     
    }
     
}
</script>

</body>

</html>