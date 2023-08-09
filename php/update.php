<?php 
    require_once('connect.php');
    if (isset($_POST['submit'])) {
        $sql1 = "UPDATE `tbcro` SET                     
                membercode = '".$_POST['membercode']."', 
                customername = '".htmlspecialchars($_POST['customername'], ENT_QUOTES, 'UTF-8')."', 
                datecro = '".$_POST['datecro']."', 
                amount = '".$_POST['amount']."',
                sales = '".$_POST['sales']."',
                shipping = '".$_POST['ship']."',
                updated_at = '".date("Y-m-d H:i:s")."'
                WHERE croid = '".mysqli_real_escape_string($conn, $_POST['croid'])."' ";
        if (mysqli_query($conn, $sql1)) {
            echo "."; //และประกาศว่าเพิ่มสำเร็จแล้วพาผู้ใช้กลับไปยังหน้า Report
            
        } else {
            echo '<script>
                        setTimeout(function() {
                            swal({
                                    title: "บันทึกข้อมูลไม่สำเร็จ!", 
                                    text: "กรุณากรอกใหม่อีกครั้ง.", 
                                    type: "danger", 
                                    showConfirmButton: true 
                                }, function(){
                                    window.location.href = "../form-update.php"; 
                                    });
                            });
                  </script>';
        }

        $count=count($_POST["barcode"]);
	
        for($i=0;$i<$count;$i++){
        $sql = "UPDATE `tbproadd` SET
                barcode ='" . $_POST["barcode"][$i] . "',
                quantity = '".$_POST["quantity"][$i] ."', 
                unit = '".$_POST["unit"][$i] ."',
                price = '".$_POST["price"][$i] ."',
                remark = '".$_POST["remark"][$i] ."',
                problem = '".$_POST["problem"][$i] ."',
                updated_at = '".date("Y-m-d H:i:s")."'      
                WHERE croid = '".mysqli_real_escape_string($conn, $_POST['croid'])."'
                AND id = '" . $_POST['id'][$i]. "'";
            if (mysqli_query($conn, $sql)) {  // if check ว่า insert ข้อมูลสำเร็จหรือไม่
                    echo '<script>
                        setTimeout(function() {
                        swal({
                            
                                title: "แก้ไขข้อมูลสำเร็จ!", 
                                text: "Insert Successfully.", 
                                type: "success", 
                                showConfirmButton: true 
                            }, function(){
                                window.location.href = "../report.php"; 
                                });
                        });
                    </script>';
                } else {
                    echo '<script>
                    setTimeout(function() {
                    swal({
                            title: "แก้ไขข้อมูลไม่สำเร็จ!", 
                            text: "กรุณากรอกใหม่อีกครั้ง.", 
                            type: "warning", 
                            showConfirmButton: true 
                        }, function(){
                            window.location.href = "../form-update.php"; 
                            });
                    });
                    </script>';
        }
    }
    }
    mysqli_close($conn);
?>