<!--หน้า Check User และ Password Login-->
<?php
session_start();
 include('./php/connect.php') //เชื่อมต่อ DB
 ?> 

<?php
if (isset($_POST['login'])) { //if check ว่ามีการกดปุ่ม Login หรือไม่
    $username = $_POST['user_id']; //ประกาศตัวแปรสำหรับ Username
    $password = $_POST['user_password']; // ประกาศตัวแปรสำหรับ Password

    $query = "SELECT * FROM `cj_user` WHERE  id_login='$username' AND password_login='$password' "; //ดึงข้อมูลจาก DB
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) >0) { 
        $row = mysqli_fetch_array($result);

         $_SESSION["id_login"] = $row['id_login'];                  //Check Session 
         $_SESSION["password_login"] = $row['password_login'];      //Check Session
         $_SESSION["name_login"] = $row['name_login'];              //Check Session
         $_SESSION["status_login"] = $row['status_login'];          //Check Session

        if ($_SESSION["status_login"] == 'admin1') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status_login"] == 'admin2') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status_login"] == 'superadmin') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status_login"] == 'admin4') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }
        
        else  {
            echo "<meta http-equiv='refresh' content='0;url=https://cjlinfo.com/home.php'>"; 
        }
        
    } else { //ถ้าระบุรหัสผ่านผิดให้แสดง ERROR

        echo "<script>alert('ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');</script>";
        Header('Refresh:0; url=https://cjlinfo.com/home.php');
    }
} else {
    Header('Location: https://cjlinfo.com/home.php');
}



?>