<!--หน้าคำสั่งการเพิ่มข้อมูลเข้า Database-->
<?php session_start();
    require_once('connect.php'); //เรียกใช้ Database
    if (isset($_POST['submit'])) {//Check if isset ว่าได้มีการกดปุ่ม submit หรือเปล่าถ้ากดให้ทำงานต่อไป
    //เช็คข้อมูลซ้ำ//
    $cro1 = $_POST['croid'];
    $sql_ck = "SELECT * FROM `tbcro` WHERE croid ='$cro1'";
    $result_ck = mysqli_query($conn, $sql_ck);
    $row_ck = mysqli_fetch_assoc($result_ck);
    //เช็คข้อมูลซ้ำ//
    if ($cro1 == $row_ck['croid']) {
        echo '<script>
        setTimeout(function() {
         swal({
             title: "เลขที่ CRO ซ้ำ!",
             text: "กรุณากรอกข้อมูลใหม่.",
             type: "warning",
             showConfirmButton: true
         }, function() {
             window.location = "../form-create.php"; //หน้าที่ต้องการให้กระโดดไป
         });
        }, 1000);
        </script>';
    } else {
        //ประกาศตัวแปร และ ใช้คำสั่งในการเพิ่มข้อมูลลง Table ใน Database
        $sql1 = "INSERT INTO `tbcro`(`croid`, `datecro` , `membercode`, `customername`, `amount`, `sales`, `shipping`, `created_at`, `updated_at`, `status_login`) 
        VALUES (
                    UPPER('".htmlspecialchars($_POST['croid'], ENT_QUOTES, 'UTF-8')."'),
                    '".$_POST['datecro']."', 
                    UPPER('".$_POST['membercode']."'), 
                    '".htmlspecialchars($_POST['customername'], ENT_QUOTES, 'UTF-8')."', 
                    '".$_POST['amount']."', 
                    '".$_POST['sales']."', 
                    '".$_POST['ship']."', 
                    '".date("Y-m-d H:i:s")."',
                    '".date("Y-m-d H:i:s")."',
                    '".$_SESSION['status_login']."'
                    )";
                    if (mysqli_query($conn, $sql1)) { // if check ว่า insert ข้อมูลสำเร็จหรือไม่
                        echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
                        header('Refresh:0; url= ../report.php');
                        
                    } else {  //ถ้าไม่สำเร็จให้แสดงหน้า ERROR
                        echo '<script>alert("เพิ่มข้อมูลไม่สำเร็จ!!")</script>';
                        header('Refresh:0; url= ../form-create.php');
                    }
                    
        //ประกาศตัวแปร และ ใช้คำสั่งในการเพิ่มข้อมูลลง Table ใน Database            
        $sql = "INSERT INTO `tbproadd`(`croid`, `barcode`, `quantity`, `unit`, `price`, `remark`, `problem`, `created_at`, `updated_at`)  
        VALUES (
                    UPPER('".htmlspecialchars($_POST['croid'], ENT_QUOTES, 'UTF-8')."'),
                    UPPER('".$_POST['barcode']."'),  
                    '".$_POST['quantity']."', 
                    '".$_POST['unit']."',
                    '".$_POST['price']."',
                    '".$_POST['remark']."',
                    '".$_POST['problem']."',
                    '".date("Y-m-d H:i:s")."',
                    '".date("Y-m-d H:i:s")."')";
                    if (mysqli_query($conn, $sql)) {  // if check ว่า insert ข้อมูลสำเร็จหรือไม่
                        for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){  //ใช้คำสั่ง for และ if เพื่อให้ Loop check ว่ามีการ Insert ข้อมูลแบบ Dynamic หรือไม่
                            if(isset($_POST["barcode$i"]))
                            {
                                if ($_POST["barcode$i"] != "" &&  //check ว่ามีการเพิ่มข้อมูลหรือไม่
                                        $_POST["quantity$i"] != "" &&
                                        $_POST["unit$i"] != "" &&
                                        $_POST["price$i"] != "" &&
                                        $_POST["remark$i"] != "" &&
                                        $_POST["problem$i"] != "" &&
                                        date("Y-m-d H:i:s")!= "")
                                {   //ถ้ามีการเพิ่มแบบ Dynamic ก็ให้เพิ่มลง table ใน database
                                    $sql2 = "INSERT INTO tbproadd (croid, barcode,  quantity, unit, price, remark, problem) 
                                        VALUES (UPPER('".htmlspecialchars($_POST['croid'], ENT_QUOTES, 'UTF-8')."'),UPPER('".$_POST["barcode$i"]."'),'".$_POST["quantity$i"]."'
                                        ,'".$_POST["unit$i"]."','".$_POST["price$i"]."','".$_POST["remark$i"]."','".$_POST["problem$i"]."')";
                                    $query = mysqli_query($conn,$sql2); //query เก็บข้อมูล
                                }
                            }
                        }
                        
                    } else { //ถ้าไม่สำเร็จ ให้ประกาศ Failed 
                        echo '<script>alert("เพิ่มข้อมูลไม่สำเร็จ!!")</script>';
        header('Refresh:0; url= ../form-create.php');
                    }
                
                    

    }
    }
    mysqli_close($conn);
?>