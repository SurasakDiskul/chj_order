<!--หน้า Auto Fetch ข้อมูลลูกค้า-->
<?php
include('connect.php') //เชื่อมต่อ DB
?>
<?php
if (isset($_POST['membercode'])) { //if check ว่ามีการกรอก membercode มาหรือเปล่า
    $membercodes = $_POST['membercode']; //ประกาศตัวแปลสำหรับ membercode ที่กรอก
    $sql_cus = "SELECT * FROM `tbcus` WHERE membercode ='$membercodes'"; //เลือกข้อมูลลูกค้าที่มี membercode ตรงกัน
      $result_cus = mysqli_query($conn, $sql_cus); //query ผลลัพธ์
      $row_cus = mysqli_fetch_assoc($result_cus); //fetch ผลลัพธ์ที่ได้มาเก็บไว้
      if ($row_cus["membercode"] != '') { //if check membercode
        $cusnames = $row_cus['cusname']; //ประกาศตัวแปรสำหรับ ชื่อลูกค้า
        $saless = $row_cus['salename'];  //ประกาศตัวแปรสำหรับ ชื่อเซลล์
        $type = $row_cus['customertype'];

          //แสดงตัว Textbox ที่มีข้อมูลลูกค้า
          echo '<div class="col-md-4">
                    <label for="customername" class="form-label text-white">ชื่อลูกค้า</label>
                    <input type="text" class="form-control " id="customername" name="customername" value="'.$cusnames.'">
                    </div>
                    <div class="col-md-4">
                    <label for="sales" class="form-label text-white">ชื่อเซลล์</label>
                    <input type="text" class="form-control " id="sales" name="sales" value="'.$saless.'">
                    </div>
                    <div class="col-md-4">
                    <label for="customertype" class="form-label text-white">ประเภทลูกค้า</label>
                    <input type="text" class="form-control " id="customertype" name="customertype" value="'.$type.'" disabled>
                    </div>';
      }else{ //ถ้า membercode ไม่ตรงกับในระบบ ให้แสดงผล ERROR
          echo '
          <label class=" h3 font2 text-danger"> ไม่เจอข้อมูลในฐานระบบ</label>
         ';
      }}
      ?>